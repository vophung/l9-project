@extends('templates.pages.master')
@section('content')
<h3 class="card-title text-left mb-3">Login</h3>
@foreach(['danger','warning','success','info'] as $msg)
@if(Session::has('alert-'. $msg))
<div class="alert alert-{{$msg}} alert-dismissible fade show" role="alert">
    <strong>{{ Session::get('alert-'. $msg) }}</strong> 
</div>
@endif
@endforeach
@if($errors->has('email') && $errors->has('password'))
    <p id="invalid-feedback">Bạn chưa nhập Email và Mật Khẩu</p>
@elseif($errors->has('email'))
    <p id="invalid-feedback">{{$errors->first('email')}}</p>
@elseif($errors->has('password'))
    <p id="invalid-feedback">{{$errors->first('password')}}</p>
@endif
@if(session('error'))
    <p id="invalid-feedback">{{session('error')}}</p>
@endif
<form action="{{route("login.store")}}" method="POST">
  @csrf
  <div class="form-group">
    <label>Email *</label>
    <input type="text" name="email" @if(Cookie::has('email')) value="{{Cookie::get('email')}}" @endif class="form-control p_input">
  </div>
  <div class="form-group">
    <label>Password *</label>
    <input type="password" name="password" @if(Cookie::has('password')) value="{{Cookie::get('password')}}" @endif class="form-control p_input">
  </div>
  <div class="form-group d-flex align-items-center justify-content-between">
    <div class="form-check">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input" @if(Cookie::has('email')) checked @endif id="rememberme" name="rememberme"> Remember me </label>
    </div>
    <a href="{{route("password.index")}}" class="forgot-pass">Forgot password</a>
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
  </div>
  <div class="d-flex">
    <a class="btn btn-facebook mr-2 col" href="{{route('facebook.redirect')}}">
      <i class="mdi mdi-facebook"></i> Facebook </a>
    <a class="btn btn-google col" href="{{route('google.redirect')}}">
      <i class="mdi mdi-google-plus"></i> Google plus </a>
  </div>
  <p class="sign-up">Don't have an Account?<a href="{{route('register.index')}}"> Sign Up</a></p>
</form>
@endsection