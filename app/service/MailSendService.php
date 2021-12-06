<?php

namespace App\service;

use App\Http\Requests\SendEmailRequest;
use App\Models\Mailing;
use Illuminate\Support\Facades\Mail;


class MailSendService
{
    public function send(
        Mailing $mail,string $emailFrom, string $subject,string $aliasFrom
    ): void
    {
        $data = array(
            'email' => $mail->email,
            'id' => $mail->id
        );
        Mail::send('emails.mailing', $data, function ($msg) use ($subject, $emailFrom, $aliasFrom, $data, $mail) {
            $msg->from($emailFrom, $aliasFrom)
                ->to($mail->mail)
                ->subject($subject);
        });
    }

}
