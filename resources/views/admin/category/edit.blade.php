@extends('admin.master')
@section('styles')
@include('admin.category.blocks.head-content-edit')
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
            <form action="{{route('category.update', $category->id)}}" method="POST" class="forms-sample">
                @csrf
                {{method_field('patch')}}
                <div class="form-group">
                    <label for="">Tiêu Đề</label>
                    <input type="text" class="form-control" id="" name="title" value="{{$category->title}}" placeholder="Tiêu Đề">
                </div>
                @if($errors->has('title'))
                <p class="card-description"><code>{{$errors->first('title')}}</code></p>
                @endif
                <div class="form-group">
                    <label for="">Mô Tả Tiêu Đề</label>
                    <input type="text" class="form-control" id="" name="metaTitle" value="{{$category->metaTitle}}" placeholder="Mô Tả Tiêu Đề">
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
                        @foreach($parent_category as $cat)
                        <option value="{{$cat->id}}"
                        @if($category->parent_category != null && $cat->id == $category->parent_category->id) selected @endif>{{$cat->title}}</option>
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
@section('scripts')
@include('admin.category.blocks.foot-content-edit')
@endsection