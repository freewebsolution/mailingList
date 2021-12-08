<?php

namespace App\Mail;

use App\Models\Mailing;
use App\service\MailSendServiceDto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Mailing $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailFrom =Config::get('mailing.emailFrom');
        $subject =Config::get('mailing.subject');
        return $this->from($emailFrom)
                    ->subject($subject)
                    ->view('emails.mailing')->with(['email'=>$this->mail]);
    }
}
