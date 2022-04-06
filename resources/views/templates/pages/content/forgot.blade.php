@extends('templates.pages.master')
@section('content')
<h3 class="card-title text-left mb-3">PASSWORD</h3>
<form action="{{route('password.email')}}" method="POST">
  @csrf
  <div class="form-group">
    <label>If you did not give us a real email address when you created your account, we cannot send you an email.</label>
  </div>
  <div class="form-group">
    <label>Enter your email to reset your password.   *</label>
    <input type="text" name="email" class="form-control p_input">
  </div>
  @if(session('status'))
    <p id="invalid-feedback">{{session('status')}}</p>
  @endif
  @if($errors->has('email'))
    <p id="invalid-feedback">{{$errors->first('email')}}</p>
    @endif
  <div class="text-center">
    <button type="submit" class="btn btn-primary btn-block enter-btn">Submit</button>
  </div>
  <p class="sign-up"><a href=""> Use phone number to reset password</a></p>
</form>
@endsection