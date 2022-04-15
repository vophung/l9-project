$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#table-products tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#table-products').DataTable({
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
 
} );

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {

    $('#table-products tbody').on('click', 'tr td #delete-button', function (e) {
        e.preventDefault();

        var detailId = $(this).attr('data-id');

        var tr = $(this).parents('tr');
        console.log(tr);
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
                    url: '/product/' + detailId,
                    cache: false,
                    success: function(data){
                        Swal.fire({
                            icon: 'success',
                            text: 'XÓA '+ data +' THÀNH CÔNG',
                            showConfirmButton: false,
                            timer: 1500
                        }).then( () => {
                            tr.remove();
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