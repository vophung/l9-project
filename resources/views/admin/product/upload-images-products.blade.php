@extends('admin.master')
@section('styles')
@include('admin.product.blocks.head-content-upload')
@endsection
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Product {{$product->title}}</h4>
            <p class="card-description"> Basic form elements </p>
            <input type="text" hidden id="uuid-product" value="{{$product->id}}">
            <div id="drag-drop-area"></div>
          </div>    
        </div>
      </div>
</div>
@endsection
@section('scripts')
@include('admin.product.blocks.foot-content-upload')
@endsection