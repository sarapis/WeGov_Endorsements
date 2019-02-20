@extends('layouts.app')
@section('title', 'Agencies and Departments')
@section('content')

<div class="demo-container mdl-grid inner_organization people_content_inner">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="page-title row ">
            <div class="col-sm-2 image_main"> 
                <img src="{{asset('images/image.jpg')}}" class="img-responsive center" >
            </div>
            <div class="col-sm-10 col-xs-12">
                <div class="pull-left org_title">{{$people->first_name}} {{$people->m_i}} {{$people->last_name}}</div><br/>
                <div class="pull-left people_title_org">{{$people->office_title}}@if($people->division_name), {{$people->division_name}}@endif<br/><a href="/organization_{{$people->organization_code}}/people">{{$people->agency_name}}</a></div>
            </div>
        </div>
        <div class="menu-bar row">
            
            <div class="tab-content people_tabpanel">
                <div role="tabpanel" class="tab-pane active" id="people_contact">
                    <div class="row">
                        <div class="col-sm-4 address">
                            <div class="box">
                                <i class="fas fa-map-marker-alt"></i>
                                <h5>Address</h5>
                                <p>{{ $people->address }}<br/>{{ $people->city }}, {{ $people->state}} {{ $people->zip_code }}</p>
                            </div>
                        </div>
                        <div class="col-sm-4 address">
                            <div class="box">
                                <i class="fas fa-phone"></i>
                                <h5>Phone</h5>
                                <p>Agency Phone: {{ $people->agency_primary_phone }} <br/>Division Phone: {{ $people->division_primary_phone }}</p>
                            </div>
                        </div>
                        <div class="col-sm-4 address">
                            <div class="box">
                                <i class="fas fa-fax"></i>
                                <h5>Fax</h5>
                                <p>Fax Number: {{ $people->fax_1 }}</p>
                            </div>
                        </div>
                    </div>
                </div>         
            </div>
        </div>
    </div>
    <form action="/organizations" method="POST" id="organization_form" class="hidden">
        {!! csrf_field() !!}
        <input value="" id="post_value" name="post_value">
        <input value="" id="post_type" name="post_type">
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $('.tag_badge').click(function(){
        val = $(this).text();
        $('#post_type').val('tag');
        $('#post_value').val(val);
        $('#organization_form').submit();
    });
    $('.type_badge').click(function(){
        val = $(this).text();
        $('#post_type').val('type');
        $('#post_value').val(val);
        $('#organization_form').submit();
    })
</script>
<script>
$(document).ready(function() {
    $('#example3').DataTable();
} );
</script>
@endsection
