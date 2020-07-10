$(document).ready(function()
{
    $('.project-link').on('click', function() {
        document.getElementById("loader").style.display = "block";
        var project_id = $(this).attr('id');
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        
        $.ajax({
            type: 'POST',
            url: '/organizationproject_'+project_id,
            contentType: false,
            cache: false, // To unable request pages to be cached
            processData: false,
            success: function(data) {
                $('#loader').hide();
                $('#project_content').html(data);
                window.history.replaceState({url: "" + window.location.href + ""}, '', window.location.href+'/'+project_id);
            },
            error: function(errResponse) {

            }
        });
        
    });
});
window.onpopstate = function (event) {
    var currentState = history.state;
    document.body.innerHTML = currentState.innerhtml;
};