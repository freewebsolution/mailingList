<?php

namespace App\service;

use App\Models\Mailing;
use Illuminate\Support\Facades\Validator;

class MailSendServiceDto
{
    public $mail;
    public $emailFrom;
    public $subject;

    public function __construct(
        Mailing $mail,
        string  $emailFrom,
        string  $subject
    )

    {
        $this->mail = $mail;
        $this->emailFrom = $emailFrom;
        $this->subject = $subject;
        $this->validate();
    }

    public static function create(
        Mailing $mail,
        string  $emailFrom,
        string  $subject
    ): self
    {
        return new self(
            $mail,
            $emailFrom,
            $subject
        );
    }

    protected function validate(): void
    {
        $fields = [
            'email' => $this->mail,
            'emailFrom' => $this->emailFrom,
            'subject' => $this->subject
        ];
        $rules =
            [
                'email'=>'required|unique:mailings,email',
                'emailFrom' => 'required|string:min:5',
                'subject' => 'required|string:min:5'
            ];

        Validator::make($fields, $rules)->validate();


    }
}
