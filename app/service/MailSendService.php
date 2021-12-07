<?php

namespace App\service;
use Illuminate\Support\Facades\Mail;
class MailSendService
{
    public function send(
        MailSendServiceDto $dto): void
    {
        $data = array(
            'email' => $dto->mail->email,
            'id' => $dto->mail->id
        );
        Mail::send('emails.mailing', $data, function ($msg) use ($data, $dto) {
            $msg->from('noreply@gmail.com','Lucio Ticali')
                ->to($dto->mail->email)
                ->subject($dto->subject);
        });
    }

}
