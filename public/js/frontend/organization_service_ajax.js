$(document).ready(function()
{
    $('.text-aqua').on('click', function() {
        document.getElementById("loader").style.display = "block";
        var service_id = $(this).attr('id');
        // console.log(service_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        
        $.ajax({
            type: 'POST',
            url: '/organizationservice_'+service_id,
            contentType: false,
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(data) {
                $('#loader').hide();
                $('#service_content').html(data);
                window.history.replaceState({url: "" + window.location.href + ""}, '', window.location.href+'/'+service_id);
            },
            error: function(errResponse) {

            }
        });      
    });
});