$(document).ready(function()
{
    $('.people-link').on('click', function() {
        document.getElementById("loader").style.display = "block";
        var contact_id = $(this).attr('id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        
        $.ajax({
            type: 'POST',
            url: '/organizationpeople_'+contact_id,
            contentType: false,
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(data) {
                $('#loader').hide();
                $('#people_content').html(data);
            },
            error: function(errResponse) {

            }
        });
        
    });
});