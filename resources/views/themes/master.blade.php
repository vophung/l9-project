<!DOCTYPE html>
<html lang="en">

<head>
    @yield('styles')
</head>

<body>
    <!-- Search Wrapper Area Start -->
    @include('themes.blocks.search-wrapper')
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        @include('themes.blocks.nav')

        <!-- Header Area Start -->
        @include('themes.blocks.aside-nav')
        <!-- Header Area End -->

        <!-- Product Catagories Area Start -->
        @yield('content')
        <!-- Product Catagories Area End -->
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Newsletter Area Start ##### -->
    @include('themes.blocks.new-letters')
    <!-- ##### Newsletter Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    @include('themes.blocks.footer')

    @yield('scripts')
</body>

</html>