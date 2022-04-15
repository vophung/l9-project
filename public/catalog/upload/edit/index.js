var uppy = new Uppy.Core({
    autoProceed: true,
    restrictions: {
        maxFileSize: 1000000, // 1mb
        maxNumberOfFiles: 4,
        minNumberOfFiles: 2
    }
})
.use(Uppy.Dashboard, {
  inline: true,
  target: '#drag-drop-area'
})
.use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

let uuid = $('#uuid-product').val();

uppy.on('complete', (result) => {
    let datapass = result.successful;
    
    $.ajax({
        type: 'POST',
        url: '/product/create/'+ uuid +'/upload-images/update',
        data: {data : JSON.stringify(datapass)},
        success: function (data) {
            console.log(data);
            window.location.href = config.routes.set;
        },
        error: function(data) {
            console.log('error');
        }
    });
})
