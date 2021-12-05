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

    public function execute(Mailing $mail):string
    {
        $email = $mail->email;

        if (!$email) {
            throw new \ErrorException();
        }
        if (Newsletter::isSubscribed($email)) {
            throw new \ErrorException();
        }
        Newsletter::subscribe($email);
        //
        $data = array(
            'email' => $email,
            'id' => $mail->id
        );
        $this->mailsendService->send($data,$email);

        return 'Error email not subscribed!!';
    }

}
