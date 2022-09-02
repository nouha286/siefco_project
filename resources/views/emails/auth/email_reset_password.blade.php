
@component('mail::message')
# Introduction
<img src="https://www.bilandecompetences.pro/wp-content/uploads/2016/02/sifco.png">
<br>
Hello {{$User->First_Name.' '.$User->Last_Name}},

@component('mail::button', ['url' => route('resetPassword',$User->id)])
Click here to reset your password
@endcomponent
<p>Or copy paste the following link on your web browser to reset your password address </p>

<p><a href="{{route('resetPassword',$User->id)}}">{{route('resetPassword',$User->id)}}</a></p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent



