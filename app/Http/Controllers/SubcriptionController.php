<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcriptions;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Notifications;
use App\Events\GeneralNotificationEvent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionVerificationMail;
use Illuminate\Support\Facades\RateLimiter;

class SubcriptionController extends Controller
{
    public function subscriptionEmail(Request $request)
    {
        $ip = $request->ip();
        $rateKey = 'subscription:' . $ip;

        // ✅ Optional Rate Limit per IP: 5x / 1 menit
        if (RateLimiter::tooManyAttempts($rateKey, 5)) {
            $seconds = RateLimiter::availableIn($rateKey);
            return FormatResponseJson::error(null, "Terlalu sering. Coba lagi dalam {$seconds} detik.", 429);
        }
        RateLimiter::hit($rateKey, 60);

        try {
            // 🧼 Sanitasi
            $sanitizedEmail = filter_var(trim($request->input('email')), FILTER_SANITIZE_EMAIL);

            // ✅ Validasi
            $validator = Validator::make(
                ['email' => $sanitizedEmail],
                [
                    'email' => [
                        'required',
                        'email:rfc,dns',
                        'max:255',
                        'unique:subcriptions,email',
                    ],
                ],
                [
                    'email.required' => 'Email wajib diisi',
                    'email.email' => 'Format email tidak valid',
                    'email.unique' => 'Email sudah terdaftar',
                ]
            );

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            DB::beginTransaction();

            // 🔒 Locking & Insert
            $existing = Subcriptions::where('email', $sanitizedEmail)
                ->lockForUpdate()
                ->first();

            if (!$existing) {
                $subscription = Subcriptions::create([
                    'email' => $sanitizedEmail,
                    'verification_token' => Str::uuid(),
                    'ip_address' => $ip,
                    'user_agent' => substr(strip_tags($request->userAgent()), 0, 255),
                    'referrer' => substr(filter_var($request->headers->get('referer'), FILTER_SANITIZE_URL), 0, 255),
                ]);

                // 🔔 Simpan notifikasi
                Notifications::create([
                    'type' => 'subscription',
                    'message' => e($sanitizedEmail).' has subscribed',
                    'url' => null,
                    'icon' => 'fas fa-bell fa-fw',
                ]);

                // 📢 Broadcast ke client
                broadcast(new GeneralNotificationEvent([
                    'type' => 'subscription',
                    'message' => e($sanitizedEmail).' has subscribed',
                    'time' => now()->toDateTimeString(),
                    'url' => null,
                    'icon' => 'fas fa-bell fa-fw',
                ]));

                // 📧 Kirim email verifikasi jika belum diverifikasi
                if (!$subscription->verified_at) {
                    Mail::to($subscription->email)->send(new SubscriptionVerificationMail($subscription));
                }
            }

            DB::commit();

            return FormatResponseJson::success(true, 'Terimakasih sudah menjadi bagian dari kami.');
        } catch (ValidationException $e) {
            RateLimiter::clear($rateKey); // clear hit rate limiter jika gagal validasi
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            RateLimiter::clear($rateKey); // clear hit jika gagal proses
            \Log::error('Subscription Error: '.$e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return FormatResponseJson::error(null, 'Terjadi kesalahan. Silakan coba lagi.', 500);
        }
    }
    public function verify($token)
    {
        $subscription = Subcriptions::where('verification_token', $token)->first();

        if (!$subscription) {
            return response()->view('admin.mail.verify-failed', [], 404);
        }

        $subscription->update([
            'is_verified' => true,
            'verified_at' => now(),
            'verification_token' => null
        ]);

        return view('admin.mail.verification_page');
    }

}
