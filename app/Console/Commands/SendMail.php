<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:sendmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to all users';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $userMail = User::select('email')->get();
        $emails = [];
        foreach ($userMail as $mail) {
            $emails[] = $mail['email'];
        }
        Mail::send('email.sendmail', [], function ($message) use ($emails) {
            $message->to($emails)->subject('Welcome to our site');
        });
    }
}
