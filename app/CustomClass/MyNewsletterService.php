<?php
namespace App\CustomClass;

use App\Models\Mailing;
use Illuminate\Support\Facades\Mail;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class MyNewsLetterService
{
    public function execute($mail,$msg)
    {
        $msg;
            try {
                if(!$mail){
                    $msg = 'Non esiste email';
                   return $msg;
                }
                if (Newsletter::isSubscribed($mail)) {
                    $msg = 'Email already subscribed';
                    return $msg;
                }
                Newsletter::subscribe($mail);
                //
                $data = array(
                    'email' => $mail,
                );
                Mail::send('emails.mailing', $data, function ($msg) use ($mail) {
                    $msg->from('noreply@email.dev', 'Lucio Ticali');
                    $msg->to($mail)->subject('Mailing list');
                });
                $msg = 'Email subscribe sucessful';
                return $msg;

            } catch (\Exception $e) {
                $msg = $e->getMessage();
                return $msg;
            }
    }
}
