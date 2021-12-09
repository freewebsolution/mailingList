<?php

namespace App\service;

use App\Models\Mailing;
use Illuminate\Support\Facades\Validator;

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

    public static function create(
        Mailing $mail
    ):self{
        return new self(
            $mail,
        );

    }

    protected function validate():void
    {
        $fields = [
            'mail'=>$this->mail,
        ];
        $rules=
            [
                'mail' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:mailings,email',
            ];
        Validator::make($fields,$rules)->validate();
    }
}
