@include('layouts.style')
<title>Find</title>

<div>
    <!--BEGIN BACK TO TOP-->
    <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
    <!--END BACK TO TOP-->
    <!--BEGIN TOPBAR-->
    @include('layouts.header')
    <!--END TOPBAR-->
    
        <!--BEGIN SIDEBAR MENU-->
        @include('layouts.menu')
        <!--END SIDEBAR MENU-->
        <div id="wrapper">
        <!--BEGIN PAGE WRAPPER-->
        <div id="page-wrapper">
            @include('layouts.sidebar')
            <!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title plxxl">
                        Find ... "{{$find}}"</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-gift"></i>&nbsp;<a href="/servive">Services</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                </ol>
                <div class="clearfix">
                </div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE-->
            <div id="tab-general">
                <div class="mbl">
                    <div class="col-lg-12">

                        <div class="col-md-12">
                            <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                            </div>
                        </div>

                    </div>

                    <div>
                    <button class="cornsilk btn-blue" style="position: absolute;top: 7px;left: auto;" id="menu-toggle">
                        <a href="" class="btn btn-secondary" style="padding: 0px;font-size: 25px;"><i class="fa  fa-search" style="color: #fff;font-size: 25px;"></i></a>
                    </button>
                        <div class="page-content">
                            <div class="row">
                                <div class="col-lg-12" style="padding: 0;">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <ul class="nav nav-tabs">
                                                <li><a href="/findorganization_{{$find}}">Organizations ({{$count_organizations}})</a></li>
                                                <li><a href="/findservice_{{$find}}">Services ({{$count_services}})</a></li>
                                                <li><a href="/findproject_{{$find}}">Projects ({{$count_projects}})</a></li>
                                                <li><a href="/findpeople_{{$find}}">People ({{$count_peoples}})</a></li>
                                            </ul>
                                            <div id="grid-layout-table-1" class="box jplist">
                                                <div class="jplist-ios-button"><i class="fa fa-sort"></i> Display Options</div>
                                                <div class="jplist-panel box panel-top">
                                                    <button type="button" data-control-type="reset" data-control-name="reset" data-control-action="reset" class="jplist-reset-btn btn btn-default">Reset<i class="fa fa-share mls"></i></button>
                                                    <div data-control-type="drop-down" data-control-name="paging" data-control-action="paging" class="jplist-drop-down form-control">
                                                        <ul class="dropdown-menu">
                                                            <li><span data-number="3"> 3 per page</span></li>
                                                            <li><span data-number="5"> 5 per page</span></li>
                                                            <li><span data-number="10" data-default="true"> 10 per page</span></li>
                                                            <li><span data-number="all"> view all</span></li>
                                                        </ul>
                                                    </div>
                                                    <div data-control-type="drop-down" data-control-name="sort" data-control-action="sort" data-datetime-format="{month}/{day}/{year}" class="jplist-drop-down form-control">
                                                        <ul class="dropdown-menu">
                                                            <li><span data-path="default">Sort by</span></li>
                                                            <li><span data-path=".title" data-order="asc" data-type="text">Title A-Z</span></li>
                                                            <li><span data-path=".title" data-order="desc" data-type="text">Title Z-A</span></li>
                                                            <li><span data-path=".desc" data-order="asc" data-type="text">Description A-Z</span></li>
                                                            <li><span data-path=".desc" data-order="desc" data-type="text">Description Z-A</span></li>
                                                            <li><span data-path=".like" data-order="asc" data-type="number" data-default="true">Likes asc</span></li>
                                                            <li><span data-path=".like" data-order="desc" data-type="number">Likes desc</span></li>
                                                            <li><span data-path=".date" data-order="asc" data-type="datetime">Date asc</span></li>
                                                            <li><span data-path=".date" data-order="desc" data-type="datetime">Date desc</span></li>
                                                        </ul>
                                                    </div>
                                                    <div data-type="Page {current} of {pages}" data-control-type="pagination-info" data-control-name="paging" data-control-action="paging" class="jplist-label btn btn-default"></div>
                                                    <div data-control-type="pagination" data-control-name="paging" data-control-action="paging" class="jplist-pagination"></div>
                                                </div>
                                                
                                                <div class="box text-shadow">

                                                    <table class="demo-tbl">
                                                        <!--<item>1</item>-->
                                                        @if($find_organizations!='')
                                                            @foreach($find_organizations as $find_organization)
                                                            <tr class="tbl-item">
                                                                
                                                                <!--<data></data>-->
                                                                <td class="td-block">

                                                                    <p class="title" style="font-size: 25px;"><a href="/organization_{{$find_organization->organizations_id}}" style="color: #357ca5;">{{$find_organization->name}}</a>  <code class="label-success"><a href="/organizations" style="font-size:20px; color: #fff;"> Organizations</a></code></p>

                                                                    <p class="desc" style="font-size: 16px;">{{str_limit($find_organization->description, 300)}}</p>

                                                                    </div>
                                                                </td>
                                                            
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                        @if($find_services!='')
                                                            @foreach($find_services as $find_service)
                                                            <tr class="tbl-item">
                                                                
                                                                <!--<data></data>-->
                                                                <td class="td-block">

                                                                    <p class="title" style="font-size: 25px;"><a href="/service_{{$find_service->service_id}}" style="color: #357ca5;">{{$find_service->name}}</a> <code class="label-info"><a href="/services" style="font-size:20px;color: #fff;"> Services</a></code></p>

                                                                    <p class="desc" style="font-size: 16px;">{{str_limit($find_service->description, 300)}}</p>

                                                                    </div>
                                                                </td>
                                                            
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                        @if($find_projects!='')
                                                            @foreach($find_projects as $find_project)
                                                            <tr class="tbl-item">
                                                                
                                                                <!--<data></data>-->
                                                                <td class="td-block">

                                                                    <p class="title" style="font-size: 25px;"><a href="/projects_{{$find_project->project_recordid}}" style="color: #357ca5;">{{$find_project->project_projectid}}</a> <code class="label-warning"><a href="/projects" style="font-size:20px;color: #fff;"> Projects</a></code></p>

                                                                    <p class="desc" style="font-size: 16px;">{{str_limit($find_project->project_description, 300)}}</p>

                                                                    </div>
                                                                </td>
                                                            
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                        @if($find_peoples!='')
                                                            @foreach($find_peoples as $find_people)
                                                            <tr class="tbl-item">
                                                                
                                                                <!--<data></data>-->
                                                                <td class="td-block">

                                                                    <p class="title" style="font-size: 25px;"><a href="/people_{{$find_people->contact_id}}" style="color: #357ca5;">{{$find_people->name}}</a> <code class="label-danger"><a href="/people" style="font-size:20px;color: #fff;"> People</a></code></p>

                                                                    <p class="desc" style="font-size: 16px;">{{str_limit($find_people->office_title, 300)}}</p>

                                                                    </div>
                                                                </td>
                                                            
                                                            </tr>
                                                            @endforeach
                                                        @endif
                                                    </table>
                                                </div>
                                                
                                                <div class="box jplist-no-results text-shadow align-center">
                                                    <p>No results found</p>
                                                </div>
                                                <div class="jplist-ios-button"><i class="fa fa-sort"></i>jPList Actions</div>
                                                <div class="jplist-panel box panel-bottom">
                                                    <div data-control-type="drop-down" data-control-name="paging" data-control-action="paging" data-control-animate-to-top="true" class="jplist-drop-down form-control">
                                                        <ul class="dropdown-menu">
                                                            <li><span data-number="3"> 3 per page</span></li>
                                                            <li><span data-number="5"> 5 per page</span></li>
                                                            <li><span data-number="10" data-default="true"> 10 per page</span></li>
                                                            <li><span data-number="all"> view all</span></li>
                                                        </ul>
                                                    </div>
                                                    <div data-control-type="drop-down" data-control-name="sort" data-control-action="sort" data-control-animate-to-top="true" data-datetime-format="{month}/{day}/{year}" class="jplist-drop-down form-control">
                                                        <ul class="dropdown-menu">
                                                            <li><span data-path="default">Sort by</span></li>
                                                            <li><span data-path=".title" data-order="asc" data-type="text">Title A-Z</span></li>
                                                            <li><span data-path=".title" data-order="desc" data-type="text">Title Z-A</span></li>
                                                            <li><span data-path=".desc" data-order="asc" data-type="text">Description A-Z</span></li>
                                                            <li><span data-path=".desc" data-order="desc" data-type="text">Description Z-A</span></li>
                                                            <li><span data-path=".like" data-order="asc" data-type="number" data-default="true">Likes asc</span></li>
                                                            <li><span data-path=".like" data-order="desc" data-type="number">Likes desc</span></li>
                                                            <li><span data-path=".date" data-order="asc" data-type="datetime">Date asc</span></li>
                                                            <li><span data-path=".date" data-order="desc" data-type="datetime">Date desc</span></li>
                                                        </ul>
                                                    </div>
                                                    <div data-type="{start} - {end} of {all}" data-control-type="pagination-info" data-control-name="paging" data-control-action="paging" class="jplist-label btn btn-default"></div>
                                                    <div data-control-type="pagination" data-control-name="paging" data-control-action="paging" data-control-animate-to-top="true" class="jplist-pagination"></div>
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
            <!--BEGIN FOOTER-->
            <div id="footer">
                <div class="copyright">
                    <a href="#">&copy; ThemesGround 2015. Designed by ThemesGround </a></div>
            </div>
            <!--END FOOTER-->
        </div>
        <!--END CONTENT-->
    </div>
    <!--END PAGE WRAPPER-->
</div>
@include('layouts.script')
