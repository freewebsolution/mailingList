<?php

namespace App\service;

use PhpParser\Node\Expr\Cast\Object_;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class MyNewsletterService
{
    public function __construct(MailSendService $service)
    {
        $this->mailsendService = $service;
    }

    public function execute(object $mail, string $msg=null)
    {
        $email = $mail->email;

        if (!$email) {
            $msg = 'Not exisist email';
            return $msg;
        }
        if (Newsletter::isSubscribed($email)) {
            $msg = 'Email already subscribed';
            return $msg;
        }
        Newsletter::subscribe($email);
        //
        $data = array(
            'email' => $email,
            'id' => $mail->id
        );
        $this->mailsendService->send($data, $email);
        $msg = 'Email subscribe sucessful';

        return MyNewsletterService::class;
    }

}
