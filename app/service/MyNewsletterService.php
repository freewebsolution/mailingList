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

        if (!$dto->mail) {
            throw new \ErrorException('Email is empty!');
        }
        if (Newsletter::isSubscribed($dto->mail)) {
            throw new \ErrorException('The email ' . $dto->mail . ' is already subscribed!');
        }
        try {
            Newsletter::subscribe($dto->mail);
            UserRegistered::dispatch($dto->mail);
            return 'Email ' . $dto->mail->email . ' successfull subscribed!!';
        }catch (Exception $e){
            return $e->getErrors();
        }

    }

}
