@extends('admin.master')
@section('styles')
@include('admin.product.blocks.head-content-create')
@endsection
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Product Form</h4>
            <p class="card-description"> Basic form elements </p>
            <form method="POST" action="{{route('product.store')}}" class="forms-sample" id="product-create" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-4">
                        <label for="">Tên Sản Phẩm</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Name">
                        @if($errors->has('title'))
                        <p class="card-description"><code>{{$errors->first('title')}}</code></p>
                        @endif
                          </div>
                        <div class="form-group col-4">
                            <label for="">Slug Link</label>
                            <input type="text" class="form-control" id="slug" style="color: black;" disabled placeholder="Slug Link">
                          </div>
                </div>
                <div class="row">
                  <div class="form-group col-8">
                    <label>Loại Sản Phẩm</label>
                    <select class="js-example-basic-multiple" name="category_id[]" multiple="multiple" style="width:100%">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                    </select>
                </div>
                </div>
                <div class="row">
                      <div class="form-group col-4">
                        <label for="">Giá</label>
                        <input type="tel" class="form-control prc" maxlength='16' name="price" id="price" placeholder="10,000VND">
                        @if($errors->has('price'))
                        <p class="card-description"><code>{{$errors->first('price')}}</code></p>
                        @endif
                        <p class="card-description" id="text-error"><code class="error"></code></p>
                      </div>
                      <div class="form-group col-4">
                        <label for="">Giảm Giá</label>
                        <input type="tel" class="form-control prc" maxlength="6" name="discount" id="discount" placeholder="0%">
                        @if($errors->has('discount'))
                        <p class="card-description"><code>{{$errors->first('discount')}}</code></p>
                        @endif
                      </div>
                </div>
                <div class="row">
                  <div class="form-group col-4">
                    <label for="">Total</label>
                    <input type="tel" class="form-control" style="color: black" disabled name="sum" id="sum" placeholder="Sum">
                  </div>
                  <div class="form-group col-4">
                    <label for="">Số Lượng</label>
                    <div class="quantity">
                      <input type="number" name="quantity" min="1" max="9" step="1" value="1">
                    </div>
                  </div>
                  @if($errors->has('quantity'))
                  <p class="card-description"><code>{{$errors->first('quantity')}}</code></p>
                  @endif
                </div>
              <div class="form-group">
                <label for="">Tóm Lược Sản Phẩm</label>
                <textarea class="form-control" id="summary-ckeditor" name="sumary" rows="6"></textarea>
                @if($errors->has('summary'))
                <p class="card-description"><code>{{$errors->first('sumary')}}</code></p>
                @endif
              </div>
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="shop" id="customSwitch1" checked>
                <label class="custom-control-label" for="customSwitch1">Toggle Publish</label>
              </div>
                </br>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <a href="{{route('product.index')}}" class="btn btn-dark">Cancel</a>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection
@section('scripts')
@include('admin.product.blocks.foot-content-create')
@endsection