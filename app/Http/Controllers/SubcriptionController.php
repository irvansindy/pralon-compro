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
class SubcriptionController extends Controller
{
    public function subscriptionEmail(Request $request)
    {
        try {
            // Sanitize input sebelum validasi
            $sanitizedEmail = filter_var($request->input('email'), FILTER_SANITIZE_EMAIL);

            $validator = Validator::make(
                ['email' => $sanitizedEmail],
                [
                    'email' => [
                        'required',
                        'email:rfc,dns', // validasi strict
                        'max:255',
                        'unique:subcriptions,email',
                    ],
                ],
                [
                    'email.required' => 'Email is required',
                    'email.email' => 'Email is not valid',
                    'email.unique' => 'Email already exists',
                ]
            );

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            DB::transaction(function () use ($sanitizedEmail, $request) {
                // Pessimistic Lock
                $existing = Subcriptions::where('email', $sanitizedEmail)
                    ->lockForUpdate()
                    ->first();

                if (!$existing) {
                    $subscription = Subcriptions::create([
                        'email' => $sanitizedEmail,
                        'verification_token' => Str::uuid(),
                        'ip_address' => $request->ip(),
                        'user_agent' => substr(strip_tags($request->userAgent()), 0, 255), // limit dan strip tag
                        'referrer' => substr(filter_var($request->headers->get('referer'), FILTER_SANITIZE_URL), 0, 255),
                    ]);

                    Notifications::create([
                        'type' => 'subscription',
                        'message' => e($sanitizedEmail).' has subscribed',
                        'url' => null,
                        'icon' => 'fas fa-bell fa-fw',
                    ]);

                    broadcast(new GeneralNotificationEvent([
                        'type' => 'subscription',
                        'message' => e($sanitizedEmail).' has subscribed',
                        'time' => now()->toDateTimeString(),
                        'url' => null,
                        'icon' => 'fas fa-bell fa-fw',
                    ]));

                    if (!$subscription->verified_at) {
                        Mail::to($subscription->email)->send(new SubscriptionVerificationMail($subscription));
                    }
                }
            });

            return FormatResponseJson::success(true, 'Terimakasih sudah menjadi bagian dari kami.');
        } catch (ValidationException $e) {
            DB::rollBack();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
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
