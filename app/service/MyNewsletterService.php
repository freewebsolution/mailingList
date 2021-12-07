<?php

namespace App\service;

use App\Models\Mailing;
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
        $dto = MailSendServiceDto::create($mail,$emailFrom,$aliasFrom,$subject);
        Newsletter::subscribe($mail->email);
        $this->mailsendService->send($dto->mail->email,$dto->emailFrom,$dto->aliasFrom,$dto->subject);

        return 'Email ' . $mail->email . ' successfull subscribed!!';
    }

}
