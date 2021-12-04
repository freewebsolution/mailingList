<?php

namespace App\service;

use Illuminate\Support\Facades\Mail;


class MailSendService
{
    public function send($data, $email):MailSendService
    {
        Mail::send('emails.mailing', $data, function ($msg) use ($data, $email) {
            $msg->from('noreply@email.dev', 'Lucio Ticali');
            $msg->to($email)->subject('Mailing list');
        });
        return new MailSendService();
    }

}
