<?php

namespace App\service;

use App\Models\Mailing;
use Illuminate\Support\Facades\Mail;


class MailSendService
{
    public function send(
        Mailing $mail,string $emailFrom,string $aliasFrom, string $subject): void
    {
        $data = array(
            'email' => $mail->email,
            'id' => $mail->id
        );
        Mail::send('emails.mailing', $data, function ($msg) use ($data, $mail,$emailFrom, $aliasFrom, $subject) {
            $msg->from('noreply@gmail.com','Lucio Ticali')
                ->to($mail->email)
                ->subject($subject);
        });
    }

}
