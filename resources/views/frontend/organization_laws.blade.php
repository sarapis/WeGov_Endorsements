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
                <li><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                <li class="active" style="width:216px;"><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
                <li style="width:125px;"><a href="/organization_{{$organization->organizations_id}}/legislation" id="legislation_tab">LEGISLATION</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="laws">
                    <div class="row">
                        <div class="col-sm-12">
                            <p>Agencies are governed by three documents: the city charter explains their purpose, the administrative code explains what they’re supposed to do and the rules explain how they’ve supposed to do it (more or less). Below you can see where this agency is mentioned in these important documents.</p>
                        </div>
                        <div class="col-sm-4">
                            <div class="box text-center" style="min-height: 390px;">
                                <div class="box-header"><h3 class="box-title">Charter</h3></div>
                                <div class="box-body">
                                    <iframe frameborder=0 src="{{$organization->charter}}" class="charter-iframe"></iframe>
                                    <a class="btn btn-charter" href="http://{{$organization->charter}}" target="_blank">Go to the Charter</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box text-center" style="min-height: 390px;">
                                
                                <div class="box-header"><h3 class="box-title">Administrative Code</h3></div>
                                <div class="box-body">
                                    <iframe frameborder=0 src="{{$organization->code}}" class="charter-iframe"></iframe>
                                    <a class="btn btn-charter" target="_blank" href="http://{{$organization->code}}">Go to the Code</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box text-center" style="min-height: 390px;">
                                <div class="box-header"><h3 class="box-title">Rules</h3></div>
                                <div class="box-body">
                                    <iframe frameborder=0 src="{{$organization->rules}}" class="charter-iframe"></iframe>
                                    <a class="btn btn-charter" target="_blank" href="http://{{$organization->rules}}">Go to the Rules</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
