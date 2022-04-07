@extends('admin.master')
@section('page-header')
<div class="page-header">
  <h3 class="page-title"> Basic Tables </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Tables</a></li>
      <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
    </ol>
  </nav>
</div>
@endsection
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Bordered table</h4>
        <a href="{{route('category.create')}}" class="btn btn-success btn-fw">Add</a>
        </p>
        <div class="table-responsive">
          <table id="datatable-category" class="table table-bordered">
            <thead>
              <tr>
                <th> # </th>
                <th> Tiêu Đề </th>
                <th> Mô Tả </th>
                <th> Parent Category </th>
                <th> Deadline </th>
              </tr>
            </thead>
            <tbody>
              @foreach($categories as $category)
              <tr>
                <td> {{$loop->iteration}} </td>
                <td> <a href="{{route('category.edit', $category->id)}}">{{$category->title}}</a> </td>
                <td> {{$category->metaTitle}}</td>
                <td> @if($category->parent_category != null) {{$category->parent_category->title}} @else Nothing @endif</td>
                <td> 
                  <button type="button" id="delete-button" data-id="{{$category->id}}" class="btn btn-danger btn-rounded btn-icon">
                    <i class="mdi mdi-delete-forever"></i>
                  </button>
              </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js-content')
@include('admin.category.blocks.js-content-index')
@endsection