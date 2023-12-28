@component('mail::message')
# Hello

You are receiving this email because someone try to login to your central panel at shikkha.

Here is your verification code for Email verification

@component('mail::panel')
<h1 style="font-size: 20px;text-align: center; margin: 0">Your OTP is: {{$otp}}</h1>
@endcomponent

This OTP will expire in 5 minutes.

Do not share your OTP to anyone. If you need any help, contact with Admin.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
