<?php

namespace App\service;

use App\Models\Mailing;
use Illuminate\Support\Facades\Validator;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class MyNewsletterServiceDto
{
    public $mail;


    public function __construct(
        Mailing $mail
    )

    {
        $this->mail = $mail;
        $this->validate();
    }

    public static function create(Mailing $mail):self{
        return new self($mail);
    }

    protected function validate():void
    {
        if (!$this->mail) {
            throw new \ErrorException('Email is empty!');
        }
        if (Newsletter::isSubscribed($this->mail)) {
            throw new \ErrorException('The email ' . $this->mail . ' is already subscribed!');
        }

        $fields = [
            'email'=>$this->mail,
        ];
        $rules=
            [
                'email'=>'required|unique:mailings,email'
            ];
        Validator::make($fields,$rules)->validate();
    }
}
