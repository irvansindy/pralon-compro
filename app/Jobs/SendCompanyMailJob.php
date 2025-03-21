<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyMail;
class SendCompanyMailJob
//  implements ShouldQueue
{
    // use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    // protected $email;
    // protected $mailData;
    /**
     * Create a new job instance.
     */
    /**
     * Send email synchronously.
     *
     * @param string $email
     * @param array $mailData
     */
    // public function __construct(string $email, array $mailData)
    // {
    //     $this->email = $email;
    //     $this->mailData = $mailData;
    // }

    /**
     * Execute the job.
     */
    public static function send(string $email, array $mailData)
    {
        Mail::to($email)->send(new CompanyMail([
            'subject' => $mailData['subject'],
            'name' => $mailData['name'],
            'head' => $mailData['head'],
            'body' => $mailData['body'],
        ]));
    }
    // for using queue
    // public function handle(): void
    // {
    //     Mail::to($this->email)->send(new CompanyMail([
    //         'subject' => $this->mailData['subject'],
    //         'name' => $this->mailData['name'],
    //         'head' => $this->mailData['head'],
    //         'body' => $this->mailData['body'],
    //     ]));
    // }
}
