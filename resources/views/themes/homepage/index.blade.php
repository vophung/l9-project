@extends('themes.master')
@section('styles')
@include('themes.shop.blocks.head-content-index')
@endsection
@section('content')
<div class="products-catagories-area clearfix">
    <div class="amado-pro-catagory clearfix">

        <!-- Single Catagory -->
        <div class="single-products-catagory clearfix">
            <a href="shop.html">
                <img src="{{asset('shopping/img/bg-img/1.jpg')}}" alt="">
                <!-- Hover Content -->
                <div class="hover-content">
                    <div class="line"></div>
                    <p>From $180</p>
                    <h4>Modern Chair</h4>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@include('themes.shop.blocks.foot-content-index')
@endsection