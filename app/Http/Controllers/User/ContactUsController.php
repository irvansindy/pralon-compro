<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\Notifications;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\EmailTemplate;
use App\Jobs\SendCompanyMailJob;
use App\Events\GeneralNotificationEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Mews\Purifier\Facades\Purifier;
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
            // 💡 Frontend rate-limit: max 5 request per 60 detik per IP
            $key = 'send-email:' . $request->ip();
            if (RateLimiter::tooManyAttempts($key, 5)) {
                $seconds = RateLimiter::availableIn($key);
                return FormatResponseJson::error(null, "Terlalu banyak permintaan. Coba lagi dalam {$seconds} detik.", 429);
            }
            RateLimiter::hit($key, 60); // count hit, reset setelah 60 detik

            // ✅ Sanitize input sebelum validasi
            $sanitizedData = [
                'name' => strip_tags(trim($request->input('name'))),
                'email' => filter_var(trim($request->input('email')), FILTER_SANITIZE_EMAIL),
                'phone_number' => strip_tags(trim($request->input('phone_number'))),
                'type_service' => strip_tags(trim($request->input('type_service'))),
                'message_contact' => strip_tags(trim($request->input('message_contact'))),
            ];

            // ✅ Validasi request (strict rules)
            $data = Validator::make($sanitizedData, [
                'name' => 'required|string|max:100',
                'email' => 'required|email:rfc,dns|max:255',
                'phone_number' => 'required|string|max:20',
                'type_service' => 'required|string|max:50',
                'message_contact' => 'required|string|max:1000',
            ], [
                'name.required' => 'Nama harus diisi',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Email tidak valid',
                'phone_number.required' => 'Nomor telepon harus diisi',
                'type_service.required' => 'Tipe layanan harus diisi',
                'message_contact.required' => 'Pesan harus diisi',
            ]);

            $purified_name = Purifier::clean($sanitizedData['name']);
            $purified_email = Purifier::clean($sanitizedData['email']);
            $purified_phone_number = Purifier::clean($sanitizedData['phone_number']);
            $purified_type_service = Purifier::clean($sanitizedData['type_service']);
            $purified_message_contact = Purifier::clean($sanitizedData['message_contact']);

            if ($data->fails()) {
                throw new ValidationException($data);
            }

            DB::beginTransaction();

            // 📝 Simpan data ke database
            $contact_us = ContactUs::create([
                'name' => $purified_name,
                'email' => $purified_email,
                'phone_number' => $purified_phone_number,
                'type' => $purified_type_service,
                'message' => $purified_message_contact,
            ]);

            DB::commit();

            // 🚀 Ambil template email dengan cache
            $existing_template = \Cache::remember(
                'email_template_' . $sanitizedData['type_service'],
                3600, // cache 1 jam
                function () use ($sanitizedData) {
                    return EmailTemplate::where('email_type', 'like', '%' . $sanitizedData['type_service'] . '%')->first();
                }
            );

            // 📧 Kirim email async jika template ada
            if ($existing_template) {
                SendCompanyMailJob::dispatch(
                    $sanitizedData['email'],
                    [
                        'subject' => $existing_template->subject,
                        'name' => $existing_template->name,
                        'head' => $existing_template->header,
                        'body' => $existing_template->body,
                    ]
                );

                // 🔔 Buat notifikasi
                Notifications::create([
                    'type' => $sanitizedData['type_service'],
                    'message' => 'New email message from user',
                ]);

                broadcast(new GeneralNotificationEvent([
                    'type' => $sanitizedData['type_service'],
                    'message' => 'New email message from user',
                    'time' => now()->toDateTimeString()
                ]))->toOthers();
            }

            return FormatResponseJson::success($contact_us, 'Pesan berhasil dikirim, silahkan cek email untuk respon kami. Terima kasih.');
        } catch (ValidationException $e) {
            RateLimiter::clear($key); // hapus hit kalau gagal validasi
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            RateLimiter::clear($key); // hapus hit kalau gagal proses
            \Log::error('SendEmail Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return FormatResponseJson::error(null, 'Terjadi kesalahan. Silakan coba lagi.', 500);
        }
    }

}
