@component('mail::message')
# Introduction

Hello {{$User->First_Name.' '.$User->Last_Name}},
<img src="assets/logo.png">

<p>your account confirmed</p>

<!-- <p><a href="{{route('resetPassword',$User->id)}}">{{route('resetPassword',$User->id)}}</a></p> -->


Thanks,<br>
{{ config('app.name') }}
@endcomponent
