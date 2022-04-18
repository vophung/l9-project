    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="{{asset('shopping/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('shopping/js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('shopping/js/bootstrap.min.js')}}"></script>
    <!-- Plugins js -->
    <script src="{{asset('shopping/js/plugins.js')}}"></script>
    <!-- Active js -->
    <script src="{{asset('shopping/js/active.js')}}"></script>
    <script src="{{asset('assets/js/toastr.min.js')}}"></script>
    <script src="{{asset('shopping/catalog/shop.js')}}"></script>
    <script>
        @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('message') }}");
        @endif
    
        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('error') }}");
        @endif
    </script>