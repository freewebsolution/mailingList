<?php

namespace App\service;

use App\Models\Mailing;
use Illuminate\Support\Facades\Validator;

class MailSendServiceDto
{
    public $mail;
    public $emailFrom;
    public $aliasFrom;
    public $subject;

    public function __construct(
        Mailing $mail,
        string $emailFrom,
        string $aliasFrom,
        string $subject
    )

    {
        $this->mail = $mail;
        $this->emailFrom = $emailFrom;
        $this->aliasFrom = $aliasFrom;
        $this->subject = $subject;
        $this->validate();
    }

    public static function create(
        Mailing $mail,
        string $emailFrom,
        string $aliasFrom,
        string $subject
    ):self{
        return new self(
           $mail,
           $emailFrom,
           $aliasFrom,
           $subject
        );

    }

    protected function validate():void
    {
        $fields = [
            'mail'=>$this->mail,
            'emailFrom'=>$this->emailFrom,
            'aliasFrom'=>$this->aliasFrom,
            'subject'=>$this->subject
        ];
        $rules=
            [
                'mail' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:mailings,email',
                'emailFrom' => 'required|string:min:5',
                'aliasFrom' => 'required|string:min:5',
                'subject' => 'required|string:min:5'
            ];
        Validator::make($fields,$rules)->validate();
    }
}
