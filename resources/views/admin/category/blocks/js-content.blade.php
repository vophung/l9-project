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
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.8/sweetalert2.min.js"></script>