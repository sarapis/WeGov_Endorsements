$(document).ready(function()
{
    $('.text-aqua').on('click', function() {

        var service_id = $(this).attr('id');
        console.log(service_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        
        $.ajax({
            type: 'GET',
            url: '/organizationservice_'+service_id,
            contentType: false,
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(data) {
                $('#content').html(data);
            },
            error: function(errResponse) {

            }
        });
        
    });
});