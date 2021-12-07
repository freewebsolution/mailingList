<?php

namespace App\service;

use App\Models\Mailing;
use Illuminate\Support\Facades\Mail;
class MailSendService
{
    public function send($dto): void
    {
        $data = array(
            'email' => $dto->mail->email,
            'subject' => $dto->subject,
            'id' => $dto->mail->id,
        );

        Mail::send('emails.mailing', $data, function ($msg) use ($data) {
            $msg->from('noreply@gmail.com','Lucio Ticali')
                ->to($data->email)
                ->subject($data->subject);
        });
    }

}
