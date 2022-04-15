@extends('admin.master')
@section('styles')
@include('admin.product.blocks.head-content-set-upload')
@endsection
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Product {{$product->title}}</h4>
            <p class="card-description"> Basic form elements </p>
            <input type="text" hidden id="uuid-product" value="{{$product->id}}">
            <form method="POST" action="{{route('product.uploads.set.store', $product->id)}}" class="forms-sample" enctype="multipart/form-data">
              @csrf
              <div class="form-group select1">
                <label for="">Chọn Ảnh Bìa Hiển Thị</label>
                <select class="js-select1" name="default">
                  @foreach($product->images as $images)
                  <option value="{{$images->product_image_path}}">Hình {{$loop->iteration}}</option>
                  @endforeach
                </select>
              </div>
            </br>
          </br>
        </br>
              <div class="form-group select2">
                <label for="">Chọn Ảnh Hiển Thị Khia Lia Chuột Lên Sản Phẩm</label>
                <select class="js-select2" name="hover">
                  @foreach($product->images as $images)
                  <option value="{{$images->product_image_path}}">Hình {{$loop->iteration}}</option>
                  @endforeach
                </select>
              </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button class="btn btn-dark">Cancel</button>
          </form>
          </div>    
        </div>
      </div>
</div>
@endsection
@section('scripts') 
@include('admin.product.blocks.foot-content-set-upload')
@endsection