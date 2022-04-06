@extends('templates.pages.master')
@section('content')
<h3 class="card-title text-left mb-3">Register</h3>
<form action="{{route('register.store')}}" method="POST">
  @csrf
  <div class="form-group">
    <label>Username</label>
    <input type="text" name="username" value="{{old('username')}}" class="form-control p_input">
  </div>
  @if($errors->has('username'))
    <p id="invalid-feedback">{{$errors->first('username')}}</p>
  @endif
  <div class="form-group">
    <label>Email</label>
    <input type="text" name="email" value="{{old('email')}}" class="form-control p_input">
  </div>
  @if($errors->has('email'))
    <p id="invalid-feedback">{{$errors->first('email')}}</p>
  @endif
  <div class="form-group">
    <label>Password</label>
    <input type="password" id="password" name="password" class="form-control p_input">
  </div>
  @if($errors->has('password'))
    <p id="invalid-feedback">{{$errors->first('password')}}</p>
  @endif
  <div class="form-group">
    <label>Confirm Password</label>
    <input type="password" id="password_confirm" name="password_confirm" class="form-control p_input">
  </div>
  @if($errors->has('password_confirm'))
    <p id="invalid-feedback">{{$errors->first('password_confirm')}}</p>
  @endif
  <div class="form-group d-flex align-items-center justify-content-between">
    <a href="{{route("password.index")}}" class="forgot-pass">Forgot password</a>
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
  </div>
  <div class="d-flex">
    <button class="btn btn-facebook col mr-2">
      <i class="mdi mdi-facebook"></i> Facebook </button>
    <button class="btn btn-google col">
      <i class="mdi mdi-google-plus"></i> Google plus </button>
  </div>
  <p class="sign-up text-center">Already have an Account?<a href="{{route('login.index')}}"> Sign In</a></p>
  <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
</form>
@section('templates.pages.blocks.foot-content')
@include('templates.pages.content.blocks.foot-register')
@endsection
@endsection