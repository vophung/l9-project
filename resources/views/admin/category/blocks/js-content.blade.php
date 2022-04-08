<script>
    var update_select = function () {
        if($('#check-select').is(':checked')){
            $('#parent_id').prop('disabled', false);
        }else {
            $('#parent_id').prop('disabled', 'disabled');
        }
    };

    $(update_select);
    $('#check-select').change(update_select);
</script>
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

    // @if(Session::has('info'))
    // toastr.options =
    // {
    //     "closeButton" : true,
    //     "progressBar" : true
    // }
    //         toastr.info("{{ session('info') }}");
    // @endif

    // @if(Session::has('warning'))
    // toastr.options =
    // {
    //     "closeButton" : true,
    //     "progressBar" : true
    // }
    //     toastr.warning("{{ session('warning') }}");
    // @endif
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.8/sweetalert2.min.js"></script>