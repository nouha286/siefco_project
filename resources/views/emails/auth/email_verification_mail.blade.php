@if (session('email'))
@component('mail::message')
# Introduction

Hello {{$User->First_Name.' '.$User->Last_Name}},
<img src="assets/logo.png">
@component('mail::button', ['url' => route('resetPassword',$User->id)])
Click here to reset your password
@endcomponent
<p>Or copy paste the following link on your web browser to reset your password address </p>

<p><a href="{{route('resetPassword',$User->id)}}">{{route('resetPassword',$User->id)}}</a></p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent

@endif


@if(!session('email'))
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
@endif