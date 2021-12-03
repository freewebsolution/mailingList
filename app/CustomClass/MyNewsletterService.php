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
            $email = Mailing::where('email', $mail)->firstOrfail();
            try {
                if(!$email){
                    $email = '';
                }
                $email->save();
                if (Newsletter::isSubscribed($email->email)) {
                    $msg = 'Email already subscribed';
                    return $msg;
                }
                Newsletter::subscribe($email->email);
                //
                $data = array(
                    'email' => $email,
                );
                Mail::send('emails.mailing', $data, function ($msg) use ($email) {
                    $msg->from('noreply@email.dev', 'Lucio Ticali');
                    $msg->to($email)->subject('Mailing list');
                });
                $msg = 'Email subscribe sucessful';
                return $msg;

            } catch (\Exception $e) {
                return redirect()->back()->with('status', $e->getMessage());
            }
        }catch(\Exception $e){
            return redirect()->back()->with('status', $e->getMessage());
        }
    }
}
