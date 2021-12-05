<?php

namespace App\service;

use Illuminate\Support\Facades\Mail;
use App\Models\Mailing;

class MailSendService
{
    public function send(Mailing $mail):void
    {
        $data = [
            'email' => $mail->email,
            'id' => $mail->id
        ];

        Mail::send('emails.mailing', $data, function ($msg) use ($data, $mail) {
            $msg->from('noreply@email.dev', 'Lucio Ticali')
                ->to($mail->email)
                ->subject('Mailing list')
            ;
        });
    }

}
