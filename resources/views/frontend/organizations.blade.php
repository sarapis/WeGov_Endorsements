@include('layouts.style')
<style>
  .thumbnail{
    min-height: 380px;
  }
  h4{
    font-size: 16px;
  }
</style>
<title>Oragnizations</title>

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
                        Organizations</div>
                </div>
                <div class="col-sm-4" style="padding-left: 200px;">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Type @if($organization_type!=''): {{$organization_type}}@endif
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu scrollable-menu">
                            @foreach ($organizationtypes as $organization)
                            <li><a href="/organizationcategory_{{$organization->type}}">{{$organization->type}}</a></li>
                        @endforeach
                        </ul>
                    </div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-desktop"></i>&nbsp;<a href="/organization">Organizations</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
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
                            <div class="panel">
                                <div class="panel-body">
                                  <!-- search form -->
                                  <div class="row">
                                    
                                      <div class="col-sm-4 col-md-4">
                                        <div class="input-group col-md-12">
                                          <form action="/organizations_find" method="POST" class="form-group">  
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="text" class="form-control" placeholder="Search" name="find" style="margin-top: 0;width: calc(100% - 40px);"> 
                                            <span class="input-group-btn">
                                              <button class="btn btn-secondary" id="mysearchbutton" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                            </span>
                                          </form>
                                        </div>            
                                      </div>
                                      <div class="col-sm-8 col-md-8">
                                        <div class="col-sm-3 text-center">
                                          <h4><b> Expense Budgets</b> <a href="/organizations_expensedesc"> <i class="fa fa-sort-amount-desc" aria-hidden="true"></i> </a><a href="/organizations_expenseasc"> <i class="fa fa-sort-amount-asc" aria-hidden="true"></i> </a></h4>
                                        </div>
                                        <div class="col-sm-3 text-center">
                                          <h4><b> Projects Budgets</b> <a href="/organizations_projectsdesc"><i class="fa fa-sort-amount-desc" aria-hidden="true"></i></a><a href="/organizations_projectsasc"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i></a></h4>
                                        </div>
                                        <div class="col-sm-3 text-center">
                                          <h4><b> Quantity Services </b><a href="/organizations_servicesdesc"><i class="fa fa-sort-amount-desc" aria-hidden="true"></i></a><a href="/organizations_servicesasc"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i></a></h4>
                                        </div>
                                        <div class="col-sm-3 text-center">
                                          <h4><b> Quantity Projects </b><a href="/organizations_projectdesc"><i class="fa fa-sort-amount-desc" aria-hidden="true"></i></a><a href="/organizations_projectasc"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i></a></h4>
                                        </div>

                                      </div>
                                    
                                  </div> 
                                  <!-- /.search form -->
                                  <!-- Your Page Content Here -->
                                  <div class="row" id="row">
                                      @foreach ($organizations as $organization)
                                        <div class="col-md-6 col-md-4">
                                          <div class="thumbnail">
                                            <div class="caption pal" id="tblData">
                                                <a href="/organization_{{$organization->organizations_id}}" style="font-size: 20px;">{{$organization->name}}<p style="display: inline; font-size: 16px;">@if($organization->alternate_name!='')&nbsp;&nbsp;({{$organization->alternate_name}}) @endif</p></a>
                                                <p style="font-size: 16px;padding-top: 10px;">{{str_limit($organization->description, 200)}}</p>
                                                <p>Services: @if($organization->services!=null)
                                                  {{sizeof(explode(",", $organization->services))}}
                                                    @else 0 @endif</p>
                                                <p>Projects: @if($organization->projects!=null)
                                                  {{sizeof(explode(",", $organization->projects))}}
                                                    @else 0 @endif</p>
                                                <p>Expense Budget: @if($organization->expenses_budgets!=null)${{number_format($organization->expenses_budgets)}} @else $0 @endif</p>
                                                <p>Projects Budget: @if($organization->total_project_cost!=null)${{number_format($organization->total_project_cost)}} @else $0 @endif</p>                
                                            </div>
                                          </div>
                                        </div>
                                      @endforeach
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
