$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function (){
    $('.add-to-cart').on('click', function(){
        
        var id = $(this).attr('data-id');

        $.ajax({
            type: 'POST',
            url: 'cart',
            data: {
                id : id
            },
            success: function(data) {
                setTimeout(() => {
                    toastr.success(data.message, data.title);
                },500)
            }, 
            error: function(data) {
                console.log('error');
            }
        });
    });
});