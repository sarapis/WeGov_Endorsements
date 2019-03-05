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
<!--                 <div class="pull-right">
                    <p class="text-tages"> Tags: <?php 
                        $tag_names = explode(',', $organization->tags);
                    ?>
                        @foreach($tag_names as $tag_name)
                            @if($tag_name!='')
                            <span class="badge tag_badge bg-blue">{{$tag_name}}</span>
                            @endif
                        @endforeach
                    </p>
                </div>
                <div class="pull-right" style="padding-left: 20px;padding-right: 10px;">
                    <p class="text-types"> Type: 
                        <span class="badge type_badge bg-blue">{{$organization->type}}</span>
                    </p>
                </div> -->
                <div class="pull-left org_title">{{$people->first_name}} {{$people->m_i}} {{$people->last_name}}</div><br/>
                <div class="pull-left people_title_org">{{$people->office_title}} @if($people->division_name) , {{$people->division_name}} @endif<br/><a href="/organization_{{$organization->organizations_id}}">{{$organization->name}}</a></div>
                <div class="social_icon">
                    <ul>
                        <li>@if($organization->website)
                            <a target="_blank" href="http://{{$organization->website}}" title="Website"><i class="fas fa-globe"></i></a>
                            @else
                            <a title="Website"><i class="fas fa-globe bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->Facebook)
                            <a target="_blank" href="http://{{$organization->Facebook}}" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            @else
                            <a title="Facebook"><i class="fab fa-facebook-f bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->Twitter)
                            <a target="_blank" href="http://{{$organization->Twitter}}" title="Twitter"><i class="fab fa-twitter"></i></a>
                            @else
                            <a title="Twitter"><i class="fab fa-twitter bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->RSS)
                            <a target="_blank" href="http://{{$organization->RSS}}" title="RSS"><i class="fas fa-rss"></i></a>
                            @else
                            <a title="RSS"><i class="fas fa-rss bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->phones)
                            <a href="tel: {{$organization->phones}}" title="Phone"><i class="fas fa-phone"></i></a>
                            @else
                            <a title="Phone"><i class="fas fa-phone bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->email)
                            <a href="mailto: {{$organization->email}}" title="Email"><i class="fas fa-envelope"></i></a>
                            @else
                            <a title="Email"><i class="fas fa-envelope bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($organization->main_address)
                            <a target="_blank" href="https://www.google.com/maps/place/{{$organization->main_address}}" title="Address"><i class="fas fa-map-marker-alt"></i></a>
                            @else
                            <a title="Address"><i class="fas fa-map-marker-alt bg-disable"></i></a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="menu-bar row">
            <ul class="nav nav-tabs desktop_tab" role="tablist">
                @if($entity->about == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                @endif
                @if($entity->projects == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                @endif
                @if($entity->services == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                @endif
                @if($entity->money == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                @endif
                @if($entity->people == 'On')
                <li class="active"><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                @endif
                @if($entity->laws == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">LAWS</a></li>
                @endif
                @if($entity->endorsements == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/endorsements" id="laws_tab">ENDORSEMENTS</a></li>
                @endif
                @if($entity->candidates == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="legislation_tab">CANDIDATES</a></li>
                @endif
                @if($entity->requests == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
                @endif
                @if($entity->requests_from == 'On')
                <li><a href="/organization_{{$organization->organizations_id}}/requests_from" id="requests_tab">RECEIVED REQUESTS</a></li>
                @endif
            </ul>

            <button type="button" class="btn btn-raised btn-block btn-primary org_filter">Organization Filter </button>

            <div class="tab_filter_btn">
                <ul class="nav nav-tabs" role="tablist">
                    @if($entity->about == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                    @endif
                    @if($entity->projects == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                    @endif
                    @if($entity->services == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                    @endif
                    @if($entity->money == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                    @endif
                    @if($entity->people == 'On')
                    <li class="active"><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                    @endif
                    @if($entity->laws == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">LAWS</a></li>
                    @endif
                    @if($entity->endorsements == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/endorsements" id="laws_tab">ENDORSEMENTS</a></li>
                    @endif
                    @if($entity->candidates == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="legislation_tab">CANDIDATES</a></li>
                    @endif
                    @if($entity->requests == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/requests" id="requests_tab">REQUESTS</a></li>
                    @endif
                    @if($entity->requests_from == 'On')
                    <li><a href="/organization_{{$organization->organizations_id}}/requests_from" id="requests_tab">RECEIVED REQUESTS</a></li>
                    @endif
                </ul>
            </div>
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
