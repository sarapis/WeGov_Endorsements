@extends('layouts.app')
@section('title', 'Agencies and Departments')

@section('content')


<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="page-title row">
            <div class="pull-right hidden-xs">
              <p class="text-tages"> Tags: <?php 
                $tag_names = explode(',', $organization->tag_names);
                ?>
              @foreach($tag_names as $tag_name)
                @if($tag_name!='')
                  <span class="badge bg-green">
                    {{$tag_name}}</span>
                @endif
              @endforeach</p>
            </div>
            <div class="pull-right hidden-xs" style="padding-left: 20px;padding-right: 10px;">
              <p class="text-types"> Type: <span class="badge bg-blue">{{$organization->type}}</span></p>
            </div>
            <div class="pull-left">{{$organization->name}}</div>
            <input type="hidden" id="organizations_id" value="{{$organization->organizations_id}}">
        </div>
        <div class="menu-bar row">

            <ul class="nav nav-tabs" role="tablist">
                <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                <li class="active"><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                <li style="width:216px;"><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
                <li style="width:125px;"><a href="/organization_{{$organization->organizations_id}}/legislation" id="legislation_tab">LEGISLATION</a></li>
            </ul>
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="people_content">
                    <div class="container-fluid">
                        <div id="tab-general">
                            <div class="mbl">
                                    <div class="page-content">
                                        <div class="row">
                                            <div class="col-lg-8">

                                                <div class="panel">
                                                    <div class="panel-body">
                                                        <div class="note note-info">

                                                        <p><code> Name:</code> {{$people->first_name}} {{$people->m_i}} {{$people->last_name}}</p>
                                                        <p><code> Organization:</code> {{$people->agency_name}}</p>
                                                        <p><code> Title:</code> {{$people->office_title}}</p>
                                                        <p><code> Division:</code> {{$people->division_name}}
                                                        @if($people->parent_division!=''), {{$people->parent_division}}@endif @if($people->grand_parent_division!=''), {{$people->grand_parent_division}}@endif
                                                        @if($people->great_grand_parent_division!=''), {{$people->great_grand_parent_division}}@endif</p>
                                                        <p><code>Address:</code> {{$people->address}}, {{$people->city}}, {{$people->state}}, {{$people->zip_code}}</p>
                                                        <p><code> Phone:</code> {{$people->phone_1}}  {{$people->phone_2}}</p>
                                                        <p><code> Fax: </code> {{$people->fax_1}}  {{$people->fax_2}}</p>
                                                        <p><code> Agency Primary Phone:</code> {{$people->agency_primary_phone}}</p>
                                                        <p><code> Division Primary Phone:</code> {{$people->division_primary_phone}}</p>
                                                        <p><code> Section:</code> {{$people->section}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="portlet box">
                                                    <div class="portlet-header">
                                                        <div id="mymap_people"></div>
                                                    </div>
                                                    <div class="portlet-body">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">

    var locations = <?php print_r(json_encode($organization_map)) ?>;

    var mymap_people = new GMaps({
      el: '#mymap_people',
      lat: 40.712722,
      lng: -74.006058,
      zoom:10
    });

    $.each( locations, function( index, value ){
        mymap_people.addMarker({
          lat: value.latitude,
          lng: value.longitude,
          title: value.name,
         infoWindow: {
            content: ('<a href="location_'+value.location_id+'">'+value.name+'</a></br>' +value.address_1+', ' +value.city+', '+value.state_province+', '+value.postal_code)
        }
   });
});

</script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection
