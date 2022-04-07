@extends('admin.master')
@section('page-header')
<div class="page-header">
    <h3 class="page-title"> Form elements </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Forms</a></li>
        <li class="breadcrumb-item active" aria-current="page">Form elements</li>
      </ol>
    </nav>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Basic form elements</h4>
            <p class="card-description"> Basic form elements </p>
            <form action="{{route('category.store')}}" method="POST" class="forms-sample">
                @csrf
                <div class="form-group">
                    <label for="">Tiêu Đề</label>
                    <input type="text" class="form-control" id="" name="title" placeholder="Tiêu Đề">
                </div>
                @if($errors->has('title'))
                <p class="card-description"><code>{{$errors->first('title')}}</code></p>
                @endif
                <div class="form-group">
                    <label for="">Mô Tả Tiêu Đề</label>
                    <input type="text" class="form-control" id="" name="metaTitle" placeholder="Mô Tả Tiêu Đề">
                </div>
                @if($errors->has('metaTitle'))
                <p class="card-description"><code>{{$errors->first('metaTitle')}}</code></p>
                @endif
                <div class="form-group">
                    <label for="">Parent Category</label>
                    <div class="form-check form-check-primary">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="check-select" name="check-select"> Check to open select </label>
                    </div>
                    <select class="form-control" disabled id="parent_id" name="parent_id">
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{route('category.index')}}" class="btn btn-dark">Cancel</a>
            </form>
          </div>
        </div>
    </div>
</div>
@endsection
@section('js-content')
@include('admin.category.blocks.js-content')
@endsection