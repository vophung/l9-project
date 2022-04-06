@extends('templates.pages.master')
@section('content')
<p class="sign-up text-center">WELCOME TO MY WEBSITE</p>
<p class="sign-up text-center">Hi <u>{{$data['username']}}</u> !!!</p>
<p class="terms">We'll send an email to <u>{{$data['email']}}</u> in 5 minutes. Open it up to activate your account.</p>
@endsection
