<?php

namespace App\service;
use App\Events\UserRegistered;
class MailSendService
{
    public function send(
        MailSendServiceDto $dto): void
    {
        UserRegistered::dispatch($dto->mail);
    }

}
