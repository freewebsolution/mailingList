<?php

return [
    'from'=>[
        'email'=>env('EMAIL_FROM','noreply@gmail.com'),
        'name'=>env('ALIAS_FROM','Lucio Ticali'),
    ],
    'subject'=>env('SUBJECT','Add our mailing list')
];
