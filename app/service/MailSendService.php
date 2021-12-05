<?php

namespace App\service;

use App\Models\Mailing;
use Illuminate\Support\Facades\Mail;


class MailSendService
{
    public function send(Mailing $mail): void
    {
        $data = array(
            'email' => $mail->email,
            'id' => $mail->id
        );
        Mail::send('emails.mailing', $data, function ($msg) use ($data, $mail) {
            $msg->from('noreply@email.dev', 'Lucio Ticali')
                ->to($mail->mail)
                ->subject('Mailing list');
        });
    }

}
