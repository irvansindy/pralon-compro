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
        $typeServices = DB::table('email_templates')->pluck('email_type');
        return view('users.contact_us.index', compact('typeServices'));
    }
    function getEmailTemplate() {
        $data =  DB::table('email_templates')->pluck('email_type');
        return response()->json($data);
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
            // 💡 Rate limit per IP: max 5 request per 60 detik
            $key = 'send-email:' . $request->ip();
            if (RateLimiter::tooManyAttempts($key, 5)) {
                $seconds = RateLimiter::availableIn($key);
                return FormatResponseJson::error(null, "Terlalu banyak permintaan. Coba lagi dalam {$seconds} detik.", 429);
            }
            RateLimiter::hit($key, 60); // Tambah hit rate limit

            // 🧼 Sanitasi input awal
            $sanitizedData = [
                'name' => strip_tags(trim($request->input('name'))),
                'email' => filter_var(trim($request->input('email')), FILTER_SANITIZE_EMAIL),
                'phone_number' => strip_tags(trim($request->input('phone_number'))),
                'type_service' => strip_tags(trim($request->input('type_service'))),
                'message_contact' => strip_tags(trim($request->input('message_contact'))),
            ];

            // ✅ Validasi data
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

            if ($data->fails()) {
                throw new ValidationException($data);
            }

            // 🧽 XSS cleaning
            $purified_name = Purifier::clean($sanitizedData['name']);
            $purified_email = Purifier::clean($sanitizedData['email']);
            $purified_phone_number = Purifier::clean($sanitizedData['phone_number']);
            $purified_type_service = Purifier::clean($sanitizedData['type_service']);
            $purified_message_contact = Purifier::clean($sanitizedData['message_contact']);

            // 🛡️ Opsional: validasi domain email (jika dibutuhkan)
            // $allowedDomains = ['gmail.com', 'yourdomain.com'];
            // $emailDomain = substr(strrchr($purified_email, "@"), 1);
            // if (!in_array($emailDomain, $allowedDomains)) {
            //     return FormatResponseJson::error(null, 'Domain email tidak diizinkan.', 403);
            // }

            DB::beginTransaction();

            // 📝 Simpan ke database
            $contact_us = ContactUs::create([
                'name' => $purified_name,
                'email' => $purified_email,
                'phone_number' => $purified_phone_number,
                'type' => $purified_type_service,
                'message' => $purified_message_contact,
            ]);

            DB::commit();

            // 📦 Ambil template email dengan cache
            $template = \Cache::remember(
                'email_template_' . $purified_type_service,
                3600,
                fn () => EmailTemplate::where('email_type', 'like', '%' . $purified_type_service . '%')->first()
            );

            // 📤 Kirim email jika template ada
            if ($template) {
                SendCompanyMailJob::dispatch(
                    $purified_email,
                    [
                        'subject' => $template->subject,
                        'name' => $template->name,
                        'head' => $template->header,
                        'body' => $template->body,
                    ]
                );

                // 🔔 Notifikasi internal
                Notifications::create([
                    'type' => $purified_type_service,
                    'message' => 'New email message from user',
                ]);

                broadcast(new GeneralNotificationEvent([
                    'type' => $purified_type_service,
                    'message' => 'New email message from user',
                    'time' => now()->toDateTimeString()
                ]))->toOthers();
            }

            // 🧾 Log aktivitas
            \Log::info('Contact form submitted', [
                'ip' => $request->ip(),
                'email' => $purified_email,
                'type_service' => $purified_type_service
            ]);

            return FormatResponseJson::success($contact_us, 'Pesan berhasil dikirim, silakan cek email untuk respon kami. Terima kasih.');
        } catch (ValidationException $e) {
            RateLimiter::clear($key); // clear hit kalau gagal validasi
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            RateLimiter::clear($key); // clear hit kalau error
            \Log::error('SendEmail Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return FormatResponseJson::error(null, 'Terjadi kesalahan. Silakan coba lagi.', 500);
        }
    }
}
