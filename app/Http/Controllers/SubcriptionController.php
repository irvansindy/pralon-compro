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
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:subcriptions,email',
            ], [
                'email.required' => 'Email is required',
                'email.email' => 'Email is not valid',
                'email.unique' => 'Email already exists',
            ]);
    
            if ($validator->fails()) {
                if ($validator->fails()) {
                    throw new ValidationException($validator);
                }
            }
            DB::transaction(function () use ($request) {
                $email = $request->input('email');

                // Cek existing dengan pessimistic lock
                $existing = Subcriptions::where('email', $email)
                    ->lockForUpdate()
                    ->first();

                if (!$existing) {
                    $subscription = Subcriptions::create([
                        'email' => $email,
                        'verification_token' => Str::uuid(),
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->userAgent(),
                        'referrer' => $request->headers->get('referer'),
                    ]);

                    Notifications::create([
                        'type' => 'subscription',
                        'message' => $email.' has subscribed',
                        'url' => null,
                        'icon' => 'fas fa-bell fa-fw',
                    ]);

                    broadcast(new GeneralNotificationEvent([
                        'type' => 'subscription',
                        'message' => $email.' has subscribed',
                        'time' => now()->toDateTimeString(),
                        'url' => null,
                        'icon' => 'fas fa-bell fa-fw',
                    ]));

                    if (!$subscription->verified_at) {
                        $sendVerificationMail = Mail::to($subscription->email)->send(new SubscriptionVerificationMail($subscription));
                    }
                }
            });
            
            return FormatResponseJson::success(true, 'Terimakasih sudah menjadi bagian dari kami.');
        } catch (ValidationException $e) {
            DB::rollback();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return FormatResponseJson::error(null, $e->getMessage(), 500);
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
