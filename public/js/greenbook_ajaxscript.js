
$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();

    //display modal form for creating new product *********************
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        $('#frmProducts').trigger("reset");
        $('#myModal').modal('show');
    });



    //display modal form for product EDIT ***************************
    $(document).on('click','.open_modal',function(){
        var product_id = $(this).val();

        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + product_id,
            success: function (data) {
                console.log(data);
                $('#greenbook_id').val(data.id);
                $('#agency_name').val(data.agency_name);
                $('#organization_code').val(data.organization_code);
                $('#agency_acronym').val(data.agency_acronym);
                $('#agency_website').val(data.agency_website);
                $('#first_name').val(data.first_name);
                $('#last_name').val(data.last_name);
                $('#m_i').val(data.m_i);
                $('#name_suffix').val(data.name_suffix);
                $('#office_title').val(data.office_title);
                $('#division_name').val(data.division_name);
                $('#parent_division').val(data.parent_division);
                $('#grand_parent_division').val(data.grand_parent_division);
                $('#great_grand_parentdivision').val(data.great_grand_parentdivision);
                $('#address').val(data.address);
                $('#city').val(data.city);
                $('#zip_code').val(data.zip_code);
                $('#phone_1').val(data.phone_1);
                $('#phone_2').val(data.phone_2);
                $('#fax_1').val(data.fax_1);
                $('#fax_2').val(data.fax_2);
                $('#agency_primary_phone').val(data.agency_primary_phone);
                $('#division_primary_phone').val(data.division_primary_phone);
                $('#section').val(data.section);
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });



    //create new product / update existing product ***************************
    $( "#myModal" ).submit(function(e) {
    // $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 
        var formData = {
            agency_name: $('#agency_name').val(),
            organization_code: $('#organization_code').val(),
            agency_acronym: $('#agency_acronym').val(),
            agency_website: $('#agency_website').val(),
            first_name: $('#first_name').val(),
            last_name: $('#last_name').val(),
            m_i: $('#m_i').val(),
            name_suffix: $('#name_suffix').val(),
            office_title: $('#office_title').val(),
            division_name: $('#division_name').val(),
            parent_division: $('#parent_division').val(),
            grand_parent_division: $('#grand_parent_division').val(),
            great_grand_parentdivision: $('#great_grand_parentdivision').val(),
            address: $('#address').val(),
            city: $('#city').val(),
            state: $('#state').val(),
            zip_code: $('#zip_code').val(),
            phone_1: $('#phone_1').val(),
            phone_2: $('#phone_2').val(),
            fax_1: $('#fax_1').val(),
            fax_2: $('#fax_2').val(),
            agency_primary_phone: $('#agency_primary_phone').val(),
            division_primary_phone: $('#division_primary_phone').val(),
            section: $('#section').val(),

        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var id = $('#greenbook_id').val();
        console.log(id);
        var my_url = url;
        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + id;
        }

        console.log(formData);
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                // var product = '<tr id="project' + data.id + '"><td class="text-center">' + data.project_projectid + '</td><td class="text-center">' + data.project_managingagency + '</td>';
                // product += '<td class="text-center"><button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill open_modal" title="Edit details" value="' + data.bodystyleid + '"><i class="la la-edit"></i></button>';
                // product += ' <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill delete-product" title="Delete" value="' + data.bodystyleid + '"><i class="la la-trash"></i></button></td></tr>';
                
                if (state == "add"){ //if user added a new record
                    //$('#products-list').append(product);
                    //$('.m-portlet.m-portlet--mobile').before(add_alert);
                   // $('.alert.alert-success.alert-dismissible.fade.show').hide(5000);
                }else{ //if user updated an existing record
                    $('#frmProducts').trigger("reset");
                    $('#myModal').modal('hide');
                    window.location.reload(); 
                    // $("#project" + project_id).replaceWith( product );
                   // $('.m-portlet.m-portlet--mobile').before(edit_alert);
                    //$('.alert.alert-brand.alert-dismissible.fade.show').hide(5000);
                }
                
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

     //display modal form for product EDIT ***************************
    $(document).on('click','.delete-product',function(){
        var product_id = $(this).val();
       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + product_id,
            success: function (data) {
                console.log(data);
                $('#product_id').val(data.bodystyleid);
                $('#name').val(data.name);
                $('#price').val(data.abbrev);
                $('#btn-delete').val("delete");
                $('#deleteModal').modal('show');

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //delete product and remove it from TABLE list ***************************
    $(document).on('click','#btn-delete',function(){
        var product_id = $('#product_id').val();
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $.ajax({
            type: "DELETE",
            url: url + '/' + product_id,
            success: function (data) {
                console.log(data);
                $("#product" + product_id).remove();
                $('#deleteModal').modal('hide');
                var delete_alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>You successfully deleted Bodystyle.</div>';
                $('.m-portlet.m-portlet--mobile').before(delete_alert);
               // $('.show').hide(5000);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
    
});