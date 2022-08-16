@component('mail::message')
# Introduction

Hello {{$User->First_Name}},
<img src="../resources/views/Asset/logo.png">
@component('mail::button', ['url' => route('verify_email',$User->id)])
Click here to verify your email address
@endcomponent
<p>Or copy paste the following link on your web browser to verify your email address </p>

<p><a href="{{route('verify_email',$User->id)}}">{{route('verify_email',$User->id)}}</a></p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
