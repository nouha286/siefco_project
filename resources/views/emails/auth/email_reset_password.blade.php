
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



