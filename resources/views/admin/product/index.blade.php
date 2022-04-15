@extends('admin.master')
@section('styles')
@include('admin.product.blocks.head-content-index')
@endsection
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
<h4 class="card-title">Data-Table Products</h4>
<a href="{{route('product.create')}}" class="btn btn-success btn-fw">Add</a>
</p>
<table id="table-products" class="display" style="width:100%">
  <thead>
    <tr>
      <th>Tên Sản Phẩm</th>
      <th>Giá</th>
      <th>Giảm Giá</th>
      <th>Số Lượng</th>
      <th>Mã SKU</th>
      <th>Mở Bán</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($products as $product)
    <tr>
      <td>{{$product->title}}</td>
      <td>{{$product->price}}</td>
      <td>{{$product->discount}}%</td>
      <td>{{$product->quantity}}</td>
      <td>{{$product->sku}}</td>
      <td>
        @if($product->shop == 1) <label class="badge badge-success">stocking</label> @elseif ($product->shop == 0) 
        <label class="badge badge-warning">unstocking</label> @endif
      </td>
      <td> 
        <a type="button" href="{{route('product.edit', $product->id)}}" class="btn btn-inverse-primary btn-fw">
          <i class="mdi mdi-table-edit"></i>
        </a>
        <button type="button" id="delete-button" data-id="{{$product->id}}" class="btn btn-inverse-danger btn-fw">
          <i class="mdi mdi-delete-forever"></i>
        </button>
      </td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th> Tên Sản Phẩm </th>
      <th> Giá </th>
      <th> Giảm Giá </th>
      <th> Số Lượng </th>
      <th> Mã SKU </th>
      <th> Mở Bán </th>
      <th> Action </th>
    </tr>
  </tfoot>
</table>
@endsection
@section('scripts')
@include('admin.product.blocks.foot-content-index')
@endsection