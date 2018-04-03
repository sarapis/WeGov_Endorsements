@extends('admin.layouts.dashboard') @section('template_title') Data Sync @endsection @section('template_fastload_css') @endsection @section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .btn-app {
        margin: 0;
    }
    
    .probar {
        width: 80px;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Data Sync
        <small> {{ Lang::get('pages.dashboard-access-level',['access' => $access] ) }} </small>
      </h1>

    </section>
    <section class="content">

        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3>Source Name: nyc-contacts</h3>
                    </div>

                    <div class="box-body table-responsive">
                        <h4 class="box-title">Source URL: https://airtable.com/tbld7PVSKy3N7ePXB</h4>
                        <table id="user_table" class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr class="success">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Table Name</th>
                                    <th class="text-center">Total Records</th>
                                    <th class="text-center">Last Synced</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($budgets as $budget)
                                <tr>
                                    <td class="text-center">{{$budget->id}}</td>
                                    <td class="text-center">{{$budget->table_name}}</td>
                                    <td class="text-center">{{$budget->total_records}}</td>
                                    <td class="text-center">{{$budget->last_synced}}</td>
                                    <td class="text-center">
                                        <button class="badge bg-yellow sync_now {{$budget->table_name}}">Sync Now</button>
                                        <button class="badge bg-green"><a href="/{!! strtolower($budget->table_name) !!}.php" style="color: white;">View Log</a></button>
                                        <button class="badge bg-blue"><a href="tb_{!! strtolower($budget->table_name) !!}" style="color: white;">View Table</a></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3>Source Name: nyc-budgets</h3>
                    </div>

                    <div class="box-body table-responsive">
                        <h4 class="box-title">Source URL: https://airtable.com/tblnB1gcDJx9MxUNM</h4>
                        <table id="user_table" class="table table-striped table-hover table-condensed">
                            <thead>
                                <tr class="success">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Table Name</th>
                                    <th class="text-center">Total Records</th>
                                    <th class="text-center">Last Synced</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $contact)
                                <tr>
                                    <td class="text-center">{{$contact->id}}</td>
                                    <td class="text-center">{{$contact->table_name}}</td>
                                    <td class="text-center">{{$contact->total_records}}</td>
                                    <td class="text-center">{{$contact->last_synced}}</td>
                                    <td class="text-center">
                                        <button class="badge bg-yellow sync_now">Sync Now</button>
                                        <button class="badge bg-green"><a href="/{!! strtolower($contact->table_name) !!}.php" style="color: white;">View Log</a></button>
                                        <button class="badge bg-blue"><a href="/tb_{!! strtolower($contact->table_name) !!}" style="color: white;">View Table</a></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
<style type="text/css">
    button{
        width: 85px !important;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var $img = $('<img class="probar titleimage" id="title" src="images/xpProgressBar.gif" alt="Loading..." />');

        $('.sync_now').click(function(){
            $(this).hide();
            var name = $(this).parent().prev().prev().prev().html();

            $(this).after($img);
            $here = $(this);
            name = name.toLowerCase();
            $.ajax({
                type: "GET",
                url: name+'.php',
                success: function(result) {
                    $img.remove();
                    $here.show();
                    $here.html('Updated');
                    $here.removeClass('bg-yellow');
                    $here.addClass('bg-purple');
                    $here.parent().prev().html('<?php echo date("Y/m/d H:i:s"); ?>');
                }
            });
        });
        // $('.services').click(function() {
        //     $('.title1').removeClass('hidden');
        //     $.ajax({
        //         type: "GET",
        //         url: 'services.php',
        //         success: function(result) {
        //             $(".title1").addClass('hidden');
        //             $(".result1").html("Updated");
        //         }
        //     });
        // });
        // $('.locations').click(function() {
        //     $('.title2').removeClass('Updated');
        //     $.ajax({
        //         type: "GET",
        //         url: 'locations.php',
        //         success: function(result) {
        //             $(".title2").addClass('hidden');
        //             $(".result2").html("Updated");
        //         }
        //     });
        // });
        // $('.organizations').click(function() {
        //     $('.title3').removeClass('Updated');
        //     $.ajax({
        //         type: "GET",
        //         url: 'organizations.php',
        //         success: function(result) {
        //             $(".title3").addClass('hidden');
        //             $(".result3").html("Updated");
        //         }
        //     });
        // });
        // $('.phones').click(function() {
        //     $('.title4').removeClass('hidden');
        //     $.ajax({
        //         type: "GET",
        //         url: 'phones.php',
        //         success: function(result) {
        //             $(".title4").addClass('hidden');
        //             $(".result4").html("Updated");
        //         }
        //     });
        // });
        // $('.contact').click(function() {
        //     $('.title5').removeClass('hidden');
        //     $.ajax({
        //         type: "GET",
        //         url: 'contacts.php',
        //         success: function(result) {
        //             $(".title5").addClass('hidden');
        //             $(".result5").html("Updated");
        //         }
        //     });
        // });
        // $('.address').click(function() {
        //     $('.title6').removeClass('hidden');
        //     $.ajax({
        //         type: "GET",
        //         url: 'address.php',
        //         success: function(result) {
        //             $(".title6").addClass('hidden');
        //             $(".result6").html("Updated");
        //         }
        //     });
        // });
        // $('.schedule').click(function() {
        //     $('.title7').removeClass('hidden');
        //     $.ajax({
        //         type: "GET",
        //         url: 'schedule.php',
        //         success: function(result) {
        //             $(".title7").addClass('hidden');
        //             $(".result7").html("Updated");
        //         }
        //     });
        // });
        // $('.agency').click(function() {
        //     $('.title8').removeClass('hidden');
        //     $.ajax({
        //         type: "GET",
        //         url: 'agency.php',
        //         success: function(result) {
        //             $(".title8").addClass('hidden');
        //             $(".result8").html("Updated");
        //         }
        //     });
        // });
        // $('.accessibility').click(function() {
        //     $('.title9').removeClass('hidden');
        //     $.ajax({
        //         type: "GET",
        //         url: 'accessibility.php',
        //         success: function(result) {
        //             $(".title9").addClass('hidden');
        //             $(".result9").html("Updated");
        //         }
        //     });
        // });
        // $('.program').click(function() {
        //     $('.title10').removeClass('hidden');
        //     $.ajax({
        //         type: "GET",
        //         url: 'programs.php',
        //         success: function(result) {
        //             $(".title10").addClass('hidden');
        //             $(".result10").html("Updated");
        //         }
        //     });
        // });
        // $('.service_area').click(function() {
        //     $('.title11').removeClass('hidden');
        //     $.ajax({
        //         type: "GET",
        //         url: 'area.php',
        //         success: function(result) {
        //             $(".title11").addClass('hidden');
        //             $(".result11").html("Updated");
        //         }
        //     });
        // });
        // $('.taxonomy').click(function() {
        //     $('.title12').removeClass('hidden');
        //     $.ajax({
        //         type: "GET",
        //         url: 'taxonomy.php',
        //         success: function(result) {
        //             $(".title12").addClass('hidden');
        //             $(".result12").html("Updated");
        //         }
        //     });
        // });
        // $('.details').click(function() {
        //     $('.title13').removeClass('hidden');
        //     $.ajax({
        //         type: "GET",
        //         url: 'details.php',
        //         success: function(result) {
        //             $(".title13").addClass('hidden');
        //             $(".result13").html("Updated");
        //         }
        //     });
        // });
        // $('.Projects').click(function() {
        //     $('.title14').removeClass('hidden');
        //     $.ajax({
        //         type: "GET",
        //         url: 'project.php',
        //         success: function(result) {
        //             $(".title14").addClass('hidden');
        //             $(".result14").html("Updated");
        //         }
        //     });
        // });
        // $('.commitment').click(function() {
        //     $('.title15').removeClass('hidden');
        //     $.ajax({
        //         type: "GET",
        //         url: 'commitment.php',
        //         success: function(result) {
        //             $(".title15").addClass('hidden');
        //             $(".result15").html("Updated");
        //         }
        //     });
        // });
        // $('.expenses').click(function() {
        //     $('.title16').removeClass('hidden');
        //     $.ajax({
        //         type: "GET",
        //         url: 'expenses.php',
        //         success: function(result) {
        //             $(".title16").addClass('hidden');
        //             $(".result16").html("Updated");
        //         }
        //     });
        // });
    });
</script>