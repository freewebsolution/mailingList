<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Mail\SendMail;
use App\Models\Mailing;
use App\service\MailSendServiceDto;
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
     * @param \App\Events\UserRegistered $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        Mail::to($event->mail)->send(new SendMail($event->mail));

    }
}
