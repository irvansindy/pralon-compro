<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Mail;
use App\Mail\CompanyMail;
use App\Models\Notifications;
use App\Models\Subcriptions;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\EmailTemplate;
use App\Jobs\SendCompanyMailJob;
use App\Events\GeneralNotificationEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
class ContactUsController extends Controller
{
    public function index()
    {
        return view('users.contact_us.index');
    }
    public function fetch(Request $request)
    {
        try {
            $contact_us = ContactUs::all();
            return FormatResponseJson::success($contact_us, 'success');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null,$th->getMessage(), 500);
        }
    }
    public function sendEmail(Request $request)
    {
        try {
            // Validasi request dengan cara lebih ringkas
            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'phone_number' => 'required|string',
                'type_service' => 'required|string',
                'message_contact' => 'required|string',
            ], [
                'name.required' => 'Nama harus diisi',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Email tidak valid',
                'phone_number.required' => 'Nomor telepon harus diisi',
                'type_service.required' => 'Tipe layanan harus diisi',
                'message_contact.required' => 'Pesan harus diisi',
            ]);

            DB::beginTransaction();

            // Simpan data ke database
            $contact_us = ContactUs::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'type' => $data['type_service'],
                'message' => $data['message_contact'],
            ]);

            DB::commit();

            // Cek template email dari cache, fallback ke query jika tidak ada
            $existing_template = \Cache::remember(
                'email_template_' . $data['type_service'],
                3600,  // Cache 1 jam
                function () use ($data) {
                    return EmailTemplate::where('email_type', 'like', '%' . $data['type_service'] . '%')->first();
                }
            );

            // Kirim email menggunakan job (async)
            if ($existing_template) {
                SendCompanyMailJob::send($data['email'], [
                    'subject' => $existing_template->subject,
                    'name' => $existing_template->name,
                    'head' => $existing_template->header,
                    'body' => $existing_template->body,
                ]);

                Notifications::create([
                    'type' => $request->type_service,
                    'message' => 'New email message from user',
                ]);
    
                broadcast(new GeneralNotificationEvent([
                    'type' => $request->type_service,
                    'message' => 'New email message from user',
                    'time' => now()->toDateTimeString()
                ]))->toOthers();
            }

            return FormatResponseJson::success($contact_us, 'Pesan berhasil dikirim, silahkan cek email aja terkait respon yang kami berikan, terimakasih.');
        } catch (ValidationException $e) {
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
    public function subscriptionEmail(Request $request)
    {
        // Manual validasi pakai Validator::make
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subcriptions,email',
        ]);

        if ($validator->fails()) {
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
        }
        try {
            DB::transaction(function () use ($request) {
                $email = $request->input('email');

                // Cek existing dengan pessimistic lock
                $existing = Subcriptions::where('email', $email)
                    ->lockForUpdate()
                    ->first();

                if (!$existing) {
                    Subcriptions::create([
                        'email' => $email,
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->userAgent(),
                        'referrer' => $request->headers->get('referer'),
                    ]);

                    Notifications::create([
                        'type' => 'subscription',
                        'message' => 'new user has subscribed',
                    ]);
        
                    broadcast(new GeneralNotificationEvent([
                        'type' => 'subscription',
                        'message' => 'new user has subscribed',
                        'time' => now()->toDateTimeString()
                    ]));
                }
            });
            return FormatResponseJson::success(true, 'Terimakasih sudah menjadi bagian dari kami.');
        } catch (ValidationException $e) {
            // Return validation errors as JSON response
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (QueryException $e) {
            Log::error('Subscription failed: ' . $e->getMessage());
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}
