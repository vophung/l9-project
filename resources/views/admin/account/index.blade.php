@extends('admin.master')
@section('styles')
@include('admin.account.blocks.head-content-index')
@endsection
@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Information</h4>
        <p class="card-description"> Basic bootstrap input groups </p>
        <form class="forms-sample" method="POST" action="{{route('account.store')}}">
          @csrf
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">&#128222</span>
            </div>
            <input type="text" class="form-control" name="mobile" value="@if($info == '') @else {{$info->mobile}} @endif" placeholder="Telephone" aria-label="telephone" aria-describedby="basic-addon1">
          </div>
          @if($errors->has('mobile'))
          <p class="card-description"><code>{{$errors->first('mobile')}}</code></p>
          @endif
        </div>
        <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">&#127968</span>
              </div>
              <input type="text" class="form-control" value="@if($info == '') @else {{$info->address}} @endif" name="address" placeholder="Address" aria-label="address" aria-describedby="basic-addon1">
            </div>
            @if($errors->has('address'))
            <p class="card-description"><code>{{$errors->first('address')}}</code></p>
            @endif
          </div>
          <button type="submit" class="btn btn-primary mb-2">Submit</button>
      </div>
      </form>
    </div>
  </div>
@endsection
@section('scripts')
@include('admin.account.blocks.foot-content-index')
@endsection