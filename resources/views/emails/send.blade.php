@component('mail::message')
# News Letter Demo

Grazie per esserti registrato alla nostra newsletter.

@component('mail::button', ['url' => ''])
Unsubscribe
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
