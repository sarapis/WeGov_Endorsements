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

                <div role="tabpanel" class="tab-pane active" id="projects">
                  <div id="people_content">
                    <table id="example1" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr class="info">
                                <th>Name</th>
                                <th>Title</th>
                                <th>Division</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($organization_peoples as $organization_people)
                            <tr>
                                <td class="people-link" id="{{$organization_people->contact_id}}"><a href="/organization_{{$organization->organizations_id}}/people/{{$organization_people->id}}">{{$organization_people->first_name}} {{$organization_people->last_name}}</a></td>
                                <td>{{$organization_people->office_title}}</td>
                                <td>{{$organization_people->division_name}}
                                @if($organization_people->parent_division!=''), {{$organization_people->parent_division}}@endif @if($organization_people->grand_parent_division!=''), {{$organization_people->grand_parent_division}}@endif
                                @if($organization_people->great_grand_parent_division!=''), {{$organization_people->great_grand_parent_division}}@endif</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#example1').DataTable();
} );
</script>
@endsection
