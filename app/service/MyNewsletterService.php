<?php

namespace App\service;

use App\Events\UserRegistered;
use PHPUnit\Exception;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class MyNewsletterService
{
    public function __construct(MailSendService $service)
    {
        $this->mailsendService = $service;
    }

    public function execute(
        MyNewsletterServiceDto $dto
    ): string
    {
        Newsletter::subscribe($dto->mail);
        UserRegistered::dispatch($dto->mail);
        return 'Email ' . $dto->mail->email . ' successfull subscribed!!';
    }
}
