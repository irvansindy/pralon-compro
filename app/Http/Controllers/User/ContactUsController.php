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
use Illuminate\Support\Facades\Cache;
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
        // 💡 Rate limit per IP: max 5 permintaan / 60 detik
        $key = 'send-email:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return FormatResponseJson::error(null, "Terlalu banyak permintaan. Coba lagi dalam {$seconds} detik.", 429);
        }
        RateLimiter::hit($key, 60);

        // 🧾 Ambil raw input
        $rawInput = $request->only(['name', 'email', 'phone_number', 'type_service', 'message_contact']);

        // ✅ Validasi awal
        $validator = Validator::make($rawInput, [
            'name' => [
                'required', 'string', 'max:100',
                function ($attribute, $value, $fail) {
                    if (preg_match("/('|--|;|select|insert|update|delete|drop|or\s+\d+=\d+)/i", $value)) {
                        $fail('Nama mengandung karakter mencurigakan.');
                    }
                }
            ],
            'email' => 'required|email:rfc,dns|max:255',
            'phone_number' => 'required|string|max:20',
            'type_service' => 'required|string|max:50',
            'message_contact' => [
                'required', 'string',
                function ($attribute, $value, $fail) {
                    if (mb_strlen($value) > 1000) {
                        $fail('Pesan terlalu panjang.');
                    }
                    if (preg_match('/\.repeat\(|new Function|alert\(|document\.|eval\(|<script/i', $value)) {
                        $fail('Pesan mengandung karakter mencurigakan.');
                    }
                    if (preg_match("/('|--|;|select|insert|update|delete|drop|or\s+\d+=\d+)/i", $value)) {
                        $fail('Pesan mengandung karakter mencurigakan.');
                    }
                }
            ],
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'phone_number.required' => 'Nomor telepon harus diisi',
            'type_service.required' => 'Tipe layanan harus diisi',
            'message_contact.required' => 'Pesan harus diisi',
        ]);

        if ($validator->fails()) {
            RateLimiter::clear($key);
            throw new ValidationException($validator);
        }

        // 🧼 Bersihkan XSS
        $sanitized = [
            'name' => Purifier::clean(trim($rawInput['name'])),
            'email' => Purifier::clean(trim($rawInput['email'])),
            'phone_number' => Purifier::clean(trim($rawInput['phone_number'])),
            'type_service' => Purifier::clean(trim($rawInput['type_service'])),
            'message_contact' => Purifier::clean(trim($rawInput['message_contact'])),
        ];

        DB::beginTransaction();

        // 📝 Simpan ke database
        $contact_us = ContactUs::create([
            'name' => e($sanitized['name']),
            'email' => e($sanitized['email']),
            'phone_number' => e($sanitized['phone_number']),
            'type' => e($sanitized['type_service']),
            'message' => e($sanitized['message_contact']),
        ]);

        DB::commit();

        // 📦 Ambil template email
        $template = \Cache::remember(
            'email_template_' . $sanitized['type_service'],
            3600,
            fn () => EmailTemplate::where('email_type', 'like', '%' . $sanitized['type_service'] . '%')->first()
        );

        // 📤 Kirim email jika ada template
        if ($template) {
            SendCompanyMailJob::send(
                $sanitized['email'],
                [
                    'subject' => $template->subject,
                    'name' => $template->name,
                    'head' => $template->header,
                    'body' => $template->body,
                ]
            );

            Notifications::create([
                'type' => $sanitized['type_service'],
                'message' => 'New email message from user',
            ]);

            broadcast(new GeneralNotificationEvent([
                'type' => $sanitized['type_service'],
                'message' => 'New email message from user',
                'time' => now()->toDateTimeString()
            ]))->toOthers();
        }

        \Log::info('Contact form submitted', [
            'ip' => $request->ip(),
            'email' => $sanitized['email'],
            'type_service' => $sanitized['type_service']
        ]);

        return FormatResponseJson::success($contact_us, 'Pesan berhasil dikirim, silakan cek email untuk respon kami. Terima kasih.');
    } catch (ValidationException $e) {
        return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
    } catch (\Exception $e) {
        DB::rollBack();
        RateLimiter::clear($key);
        \Log::error('SendEmail Error: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);
        return FormatResponseJson::error(null, 'Terjadi kesalahan. Silakan coba lagi.', 500);
    }
}



}
