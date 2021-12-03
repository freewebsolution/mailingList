<?php
namespace App\CustomClass;

use App\Models\Mailing;
use Illuminate\Support\Facades\Mail;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class MyNewsLetterService
{
    public function execute($mail)
    {
        try {
            $email = Mailing::where('email', $mail)->firstOrfail();
            if (!$email) {
                $email = '';
            }
            try {

                if (Newsletter::isSubscribed($email->email)) {
                    return redirect()->back()->with('status', 'Email already subscribed');
                }
                Newsletter::subscribe($email->email);
                $email->save();
                $data = array(
                    'email' => $email,
                );
//            $email = $request->get('email');
                Mail::send('emails.mailing', $data, function ($msg) use ($email) {
                    $msg->from('noreply@email.dev', 'Lucio Ticali');
                    $msg->to($email)->subject('Mailing list');
                });
                return redirect()->back()->with('status', 'Email subscribe sucessful');

            } catch (\Exception $e) {
                return redirect()->back()->with('status', $e->getMessage());
            }
        }catch(\Exception $e){
            return redirect()->back()->with('status', $e->getMessage());
        }
    }
}
