$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {

    $('#datatable-category tbody').on('click', 'tr td #delete-button', function (e) {
        e.preventDefault();

        var detailId = $(this).attr('data-id');

        var tr = $(this).parents('tr');

        Swal.fire({
            title: 'Bạn có chắc chắn muốn thực hiện thao tác này?',
            text: 'Dữ liệu của bạn sẽ bị mất',
            showCancelButton: true,
            cancelButtonText: 'Trở lại',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
        }).then( (result) => {
            if(result.isConfirmed){
                $.ajax({
                    type: 'DELETE',
                    url: '/category/' + detailId,
                    cache: false,
                    success: function(data){
                        Swal.fire({
                            icon: 'success',
                            text: 'XÓA THÀNH CÔNG',
                            showConfirmButton: false,
                            timer: 1500
                        }).then( () => {
                            let tr_cat = $("#show-data tr button[data-id='"+ data.cat_id +"']");
                            tr_cat.parents('tr').remove();
                            if(data.parent_id.length > 0){
                                $.each(data.parent_id, function(k, v){
                                    let tr_child = $("#show-data tr button[data-id='"+ v.id +"']");
                                    console.log(tr_child.parents('tr').remove());
                                });
                            }
                        })
                    },
                    error: function(){
                        Swal.fire({
                            icon: 'error',
                            text: 'Something Wrong',
                            footer: 'Let us check later.'
                        })
                    }
                });
            }
        });
    } );
});