@component('mail::message')
# Welcome

You have been registered as a pokemon trainer. Please enter with your email and password: 123456.

@component('mail::button', ['url' => ''])
Ingresar
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
