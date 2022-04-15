@extends('admin.master')
@section('styles')
@include('admin.product.blocks.head-content-create')
@endsection
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Data-Table Products</h4>
            <a href="{{route('product.uploads.edit', $product->id)}}" class="btn btn-success btn-fw">Update Gallery Images</a>
            <a href="{{route('product.uploads.set.edit', $product->id)}}" class="btn btn-success btn-fw">Update Set Images</a>
            </p>
            <p class="card-description"> Basic form elements </p>
            <form method="POST" action="{{route('product.update', $product->id)}}" class="forms-sample" id="product-edit" enctype="multipart/form-data">
                @csrf
                {{method_field('patch')}}
                <div class="row">
                    <div class="form-group col-4">
                        <label for="">Tên Sản Phẩm</label>
                            <input type="text" class="form-control" id="title" value="{{$product->title}}" name="title" placeholder="Name">
                        @if($errors->has('title'))
                        <p class="card-description"><code>{{$errors->first('title')}}</code></p>
                        @endif
                          </div>
                        <div class="form-group col-4">
                            <label for="">Slug Link</label>
                            <input type="text" class="form-control" value="{{$product->slug}}" id="slug" style="color: black;" disabled placeholder="Slug Link">
                          </div>
                </div>
                <div class="row">
                  <div class="form-group col-8">
                    <label>Loại Sản Phẩm</label>
                    <select class="js-example-basic-multiple" name="category_id[]" multiple="multiple" style="width:100%">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}"
                    @if($product->category->pluck('id')->contains($category->id)) selected @endif>{{$category->title}}</option>
                    @endforeach
                    </select>
                </div>
                </div>
                <div class="row">
                      <div class="form-group col-4">
                        <label for="">Giá</label>
                        <input type="tel" class="form-control prc" value="{{$product->price}}" maxlength='16' name="price" id="price" placeholder="10,000VND">
                        @if($errors->has('price'))
                        <p class="card-description"><code>{{$errors->first('price')}}</code></p>
                        @endif
                        <p class="card-description" id="text-error"><code class="error"></code></p>
                      </div>
                      <div class="form-group col-4">
                        <label for="">Giảm Giá</label>
                        <input type="tel" class="form-control prc" value="{{$product->discount}}" maxlength="6" name="discount" id="discount" placeholder="0%">
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
                      <input type="number" value="{{$product->quantity}}" name="quantity" min="1" max="9" step="1">
                    </div>
                  </div>
                  @if($errors->has('quantity'))
                  <p class="card-description"><code>{{$errors->first('quantity')}}</code></p>
                  @endif
                </div>
              <div class="form-group">
                <label for="">Tóm Lược Sản Phẩm</label>
                <textarea class="form-control" id="summary-ckeditor" name="sumary" rows="6">
                    {{old('sumary', $product->sumary)}}
                </textarea>
                @if($errors->has('title'))
                <p class="card-description"><code>{{$errors->first('title')}}</code></p>
                @endif
              </div>
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="shop" id="customSwitch1" 
                @if(old('shop',$product->shop) == 1) checked @endif>
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