<?php

namespace App\service;

use App\Http\Requests\SendEmailRequest;
use App\Models\Mailing;
use Illuminate\Support\Facades\Config;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class MyNewsletterService
{
    public function __construct(MailSendService $service)
    {
        $this->mailsendService = $service;
    }

    public function execute(Mailing $mail):string
    {

        if (!$mail->email) {
            throw new \ErrorException('Email is empty!');
        }
        if (Newsletter::isSubscribed($mail->email)) {
            throw new \ErrorException('The email '.$mail->email.' is already subscribed!');
        }
        Newsletter::subscribe($mail->email);

        $emailFrom =Config::get('mailing.emailFrom');
        $aliasFrom =Config::get('mailing.aliasFrom');
        $subject =Config::get('mailing.subject');
        $this->mailsendService->send($mail,$emailFrom,$aliasFrom,$subject);

        return 'Email '.$mail->email.' successfull subscribed!!';
    }

}
