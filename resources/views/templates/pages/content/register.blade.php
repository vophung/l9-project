@extends('templates.pages.master')
@section('content')
<h3 class="card-title text-left mb-3">Register</h3>
<form action="{{route('register.store')}}" method="POST">
  @csrf
  <div class="form-group">
    <label>Username</label>
    <input type="text" class="form-control p_input">
  </div>
  <div class="form-group">
    <label>Email</label>
    <input type="email" class="form-control p_input">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control p_input">
  </div>
  <div class="form-group d-flex align-items-center justify-content-between">
    <div class="form-check">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input"> Remember me </label>
    </div>
    <a href="#" class="forgot-pass">Forgot password</a>
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
  <p class="sign-up text-center">Already have an Account?<a href="#"> Sign Up</a></p>
  <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
</form>
@endsection