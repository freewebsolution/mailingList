<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\Mailing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $mail = Mailing::find($event->mail)->toArray();
        Mail::send('emails.mailing', $mail, function ($msg) use ($mail) {
        $msg->from('noreply@gmail.com','Lucio Ticali')
            ->to($mail->email)
            ->subject('Event testing');
    });
    }
}
