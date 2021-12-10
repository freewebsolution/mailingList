<?php

namespace App\service;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
class MailSendService
{
    public function send(
        MailSendServiceDto $dto): void
    {
        Mail::to($dto->mail)->send(new SendMail($dto->mail));
    }

}
