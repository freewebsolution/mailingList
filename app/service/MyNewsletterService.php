<?php

namespace App\service;

use App\Events\UserRegistered;
use App\Models\Mailing;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\Facades\Event;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class MyNewsletterService
{

    public function __construct(MailSendService $service)
    {
        $this->mailsendService = $service;
    }

    public function execute(MailSendServiceDto $dto): string
    {

        if (!$dto->mail) {
            throw new \ErrorException('Email is empty!');
        }
        if (Newsletter::isSubscribed($dto->mail)) {
            throw new \ErrorException('The email ' . $dto->mail . ' is already subscribed!');
        }
        Newsletter::subscribe($dto->mail->email);
        UserRegistered::dispatch($dto->mail);
        return 'Email ' . $dto->mail->email . ' successfull subscribed!!';
    }

}
