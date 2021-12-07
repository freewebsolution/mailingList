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

    public function execute(Mailing $mail, string $emailFrom, string $aliasFrom, string $subject): string
    {

        if (!$mail->email) {
            throw new \ErrorException('Email is empty!');
        }
        if (Newsletter::isSubscribed($mail->email)) {
            throw new \ErrorException('The email ' . $mail->email . ' is already subscribed!');
        }
        Newsletter::subscribe($mail->email);
        $dto = MailSendServiceDto::create($mail,$emailFrom,$aliasFrom,$subject);
        //$this->mailsendService->send($dto);
        \event(new UserRegistered($mail));
        return 'Email ' . $mail->email . ' successfull subscribed!!';
    }

}
