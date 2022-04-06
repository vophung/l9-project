@extends('templates.pages.master')
@section('content')
<h3 class="card-title text-left mb-3">PASSWORD</h3>
<form action="{{route('password.update')}}" method="POST">
  <input type="hidden" name="token" value="{{$data['token']}}">
  @csrf
  <div class="form-group">
    <label>Email.   *</label>
    <input type="text" name="email" value="{{$data['email']}}" class="form-control p_input">
  </div>
     @if($errors->has('email'))
    <p id="invalid-feedback">{{$errors->first('email')}}</p>
    @endif
    @if($errors->has('token'))
    <p id="invalid-feedback">{{$errors->first('token')}}</p>
    @endif
    <div class="form-group">
        <label>New Password.   *</label>
        <input type="password" name="password" class="form-control p_input">
    </div>    
    @if($errors->has('password'))
    <p id="invalid-feedback">{{$errors->first('password')}}</p>
    @endif
    <div class="form-group">
        <label>Confirm Password.   *</label>
        <input type="password" name="password_confirm" class="form-control p_input">
    </div>
    @if($errors->has('password_confirm'))
    <p id="invalid-feedback">{{$errors->first('password_confirm')}}</p>
    @endif
  <div class="text-center">
    <button type="submit" class="btn btn-primary btn-block enter-btn">Reset Password</button>
  </div>
  <p class="sign-up"><a href=""> Use phone number to reset password</a></p>
</form>
@endsection