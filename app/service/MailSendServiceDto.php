<?php

namespace App\service;

use App\Models\Mailing;
use Illuminate\Support\Facades\Request;

class MailSendServiceDto
{
    public $mail;
    public $emailFrom;
    public $aliasFrom;
    public $subject;

    public static function create(
        Mailing $mail,
        string  $emailFrom,
        string  $aliasFrom,
        string  $subject
    )
    {
        (new MailSendServiceDto)->validate();
    }

    public function validate(Request $request): void
    {
        $request->validate([
            'mail' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:mailings,email',
            'emailFrom' => 'required|string:min:5',
            'aliasFrom' => 'required|string:min:5',
            'subject' => 'required|string:min:5'
        ]);
    }

}
