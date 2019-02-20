@extends('layouts.app')
@section('title', 'Agencies and Departments')
@section('content')

<div class="demo-container mdl-grid inner_organization people_content_inner">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="page-title row ">
            <div class="col-sm-2 image_main"> 
                @if($politician->picture)
                <img src="{{$politician->picture}}" class="img-responsive center" >
                @else
                <img src="{{asset('images/image.jpg')}}" class="img-responsive center" >
                @endif
            </div>
            <div class="col-sm-10 col-xs-12">
                <div class="pull-right">
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
                        <span class="badge type_badge bg-blue">{{$organization_type}}</span>
                    </p>
                </div>
                <div class="pull-left org_title">{{$politician->name}}</div><br/>
                <div class="pull-left people_title_org">{{$organization->name}}</div>
                <div class="social_icon">
                    <ul>
                        <li>@if($politician->website)
                            <a target="_blank" href="http://{{$politician->website}}" title="Website"><i class="fas fa-globe"></i></a>
                            @else
                            <a title="Website"><i class="fas fa-globe bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($politician->facebook)
                            <a target="_blank" href="http://{{$politician->facebook}}" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            @else
                            <a title="Facebook"><i class="fab fa-facebook-f bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($politician->twitter)
                            <a target="_blank" href="http://{{$politician->twitter}}" title="Twitter"><i class="fab fa-twitter"></i></a>
                            @else
                            <a title="Twitter"><i class="fab fa-twitter bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($politician->rss)
                            <a target="_blank" href="http://{{$politician->rss}}" title="RSS"><i class="fas fa-rss"></i></a>
                            @else
                            <a title="RSS"><i class="fas fa-rss bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($politician->phone)
                            <a href="tel: {{$politician->phone}}" title="Phone"><i class="fas fa-phone"></i></a>
                            @else
                            <a title="Phone"><i class="fas fa-phone bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($politician->email)
                            <a href="mailto: {{$politician->email}}" title="Email"><i class="fas fa-envelope"></i></a>
                            @else
                            <a title="Email"><i class="fas fa-envelope bg-disable"></i></a>
                            @endif
                        </li>
                        <li>@if($politician->address)
                            <a target="_blank" href="https://www.google.com/maps/place/{{$politician->address}}" title="Address"><i class="fas fa-map-marker-alt"></i></a>
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
                <li class="active"><a href="#people_campaigns" data-toggle="tab" >CAMPAIGNS</a></li>
                <li><a href="#people_endorsement" data-toggle="tab" >ENDORSEMENTS</a></li>
                <li><a href="#people_disclouser" data-toggle="tab" >DISCLOSURES</a></li>
            </ul>

            <button type="button" class="btn btn-raised btn-block btn-primary org_filter">Organization Filter </button>

            <div class="tab_filter_btn">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#people_campaigns" data-toggle="tab" >CAMPAIGNS</a></li>
                    <li><a href="#people_endorsement" data-toggle="tab" >ENDORSEMENTS</a></li>
                    <li><a href="#people_disclouser" data-toggle="tab" >DISCLOSURES</a></li>
                </ul>
            </div>
             <div class="tab-content people_tabpanel">
                <div role="tabpanel" class="tab-pane active" id="people_campaigns">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box padding_0 table_data">
                                <div class="padding_0 endosment_table table-responsive">
                                    <table id="example1" class="table table-bordered" cellspacing="0" width="100%" style="margin-bottom: 20px  !important; ">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;width: 15%;">Election</th>
                                                <th style="text-align: left;">Office</th>
                                                <th style="text-align: left;">Party</th>
                                                <th style="text-align: center;width: 10%;">Endorsements</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach($campaigns as $campaign)
                                                <tr>
                                                    <td><a href="/elections/{{$campaign->elections()->first()->year}}">{{$campaign->elections()->first()->name}}</a></td>
                                                    <td style="text-align: left;">{{$organization->name}}</td>
                                                    <td style="text-align: left;">{{$campaign->parties_name}}</td>
                                                    <td>{{$campaign->of_endorsements}}</td>
                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="people_endorsement">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box padding_0 table_data">
                                <div class="padding_0 endosment_table table-responsive">
                                    <table id="example2" class="table table-bordered" cellspacing="0" width="100%" style="margin-bottom: 20px  !important; ">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;width: 15%;">Election</th>
                                                <th style="text-align: left;">Office</th>
                                                <th style="text-align: left;">Organization</th>
                                                <th style="text-align: left;">URL</th>
                                                <th style="text-align: center;">Recorded Date</t h>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($endorsements as $endorsement)
                                            <tr>
                                                <td>{{$endorsement->elections()->first()->name}}</td>
                                                <td style="text-align: left;">{{$endorsement->offices()->first()->name}}</td>
                                                <td style="text-align: left;">@if(isset($endorsement->organizations)) {{$endorsement->organization()->first()->name}} @endif</td>
                                                <td style="text-align: left;"><a href="{{$endorsement->link}}"></a></td>
                                                <td>{{$endorsement->date_created}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div role="tabpanel" class="tab-pane" id="people_disclouser">
                    <ul class="nav nav-tabs disclosure_year" role="tablist">
                        <li class="active"><a href="#2017" data-toggle="tab" >2017</a></li>
                        <li><a href="#2016" data-toggle="tab" >2016</a></li>
                        <li><a href="#2015" data-toggle="tab" >2015</a></li>
                    </ul>
                    <div class="tab-content people_tabpanel">
                        <div role="tabpanel" class="tab-pane active" id="2017" style="padding: 0px;">
                            <div class="inner_disclosure">
                                <div class="col-sm-3">
                                    <ul class="left_dis_menu" role="tablist">
                                        <li><a class="active" href="#general_info" data-toggle="tab">General Info</a></li>
                                        <li><a href="#city_position" data-toggle="tab">City Positions</a></li>
                                        <li><a href="#other_income" data-toggle="tab">Other Income</a></li>
                                        <li><a href="#debts" data-toggle="tab">Debts</a></li>
                                        <li><a href="#real_estate" data-toggle="tab">Real Estate</a></li>
                                        <li><a href="#securities" data-toggle="tab">Securities</a></li>
                                        <li><a href="#trust" data-toggle="tab">Trust</a></li>
                                        <li><a href="#relatives" data-toggle="tab">Relatives</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row inner_dis_row">
                                        <div class="tab-content all_year_list">
                                            <!-- start general info -->
                                            <div role="tabpanel" class="tab-pane active" id="general_info">
                                                <div class="right_dis_table">
                                                    <h6>General Info</h6>
                                                    <div class="padding_0 endosment_table table-responsive">
                                                        <table id="example3" class="table table-bordered" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th style="text-align: left;">Question text</th>
                                                                    <th style="width: 20%;">Answer</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td style="text-align: left;">Question</td>
                                                                    <td>Answer</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: left;">Blabh blah blah</td>
                                                                    <td>Yes</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end general info -->

                                            <!-- start city position -->
                                            <div role="tabpanel" class="tab-pane" id="city_position">
                                                <div class="right_dis_table">
                                                    <h6>City Positions</h6>
                                                    <div class="padding_0 endosment_table table-responsive">
                                                        <table id="example3" class="table table-bordered" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr style="vertical-align: middle;">
                                                                    <th style="vertical-align: middle;">Current/Final Agency</th>
                                                                    <th style="vertical-align: middle;">Status</th>
                                                                    <th style="vertical-align: middle;">Borough</th>
                                                                    <th style="vertical-align: middle;">District</th>
                                                                    <th style="vertical-align: middle;">Address</th>
                                                                    <th style="vertical-align: middle;">Telephone</th>
                                                                    <th style="vertical-align: middle;">Position Title</th>
                                                                    <th style="vertical-align: middle;">Nature</th>
                                                                    <th style="vertical-align: middle;">Income</th>
                                                                    <th style="vertical-align: middle;">Comments</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                      
                                                                <tr>
                                                                   
                                                                    <td></td>
                                                                    
                                                                </tr>
                                                              
                                                            </tbody>
                                                        </table>
                                                       
                                                        <div class="text-right">
                                                         
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                             <!-- end city position -->

                                             <!-- start Other Incomes -->
                                             <div role="tabpanel" class="tab-pane" id="other_income">
                                                <div class="right_dis_table">
                                                    <h6>Other Income</h6>
                                                    <div class="padding_0 endosment_table table-responsive">
                                                        <table id="example3" class="table table-bordered" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr style="vertical-align: middle;">
                                                                    <th style="vertical-align: middle;">Source of Income</th>
                                                                    <th style="vertical-align: middle;">Amount of Income</th>
                                                                    <th style="vertical-align: middle;">Nature of Income</th>
                                                                    <th style="vertical-align: middle;">Comments</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                               
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                               
                                                            </tbody>
                                                        </table>
                                                     
                                                            <div class="text-right">
                                                              
                                                            </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                             <!-- end Other Incomes -->

                                             <!-- start Debts -->
                                             <div role="tabpanel" class="tab-pane" id="debts">
                                                <div class="right_dis_table">
                                                    <h6>Debts</h6>
                                                    <div class="padding_0 endosment_table table-responsive">
                                                        <table id="example3" class="table table-bordered" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr style="vertical-align: middle;">
                                                                    <th style="vertical-align: middle;">Name of Creditor</th>
                                                                    <th style="vertical-align: middle;">Type of Loan</th>
                                                                    <th style="vertical-align: middle;">Other Liability</th>
                                                                    <th style="vertical-align: middle;">Nature of Collateral</th>
                                                                    <th style="vertical-align: middle;">Name of Guarantor</th>
                                                                    <th style="vertical-align: middle;">Amount Owed</th>
                                                                    <th style="vertical-align: middle;">Comments</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                    
                                                                <tr>
                                                                    <td></td>
                                                                  
                                                                </tr>
                                                     
                                                            </tbody>
                                                        </table>
                                                       
                                                            <div class="text-right">
                                                             
                                                            </div>
                                                   
                                                    </div>
                                                </div>
                                            </div>
                                             <!-- end Debts -->

                                             <!-- start Real Estate -->
                                             <div role="tabpanel" class="tab-pane" id="real_estate">
                                                <div class="right_dis_table">
                                                    <h6>Real Estate</h6>
                                                    <div class="padding_0 endosment_table table-responsive">
                                                        <table id="example3" class="table table-bordered" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr style="vertical-align: middle;">
                                                                    <th style="vertical-align: middle;">Address</th>
                                                                    <th style="vertical-align: middle;">Size of Property</th>
                                                                    <th style="vertical-align: middle;">Nature of Property</th>
                                                                    <th style="vertical-align: middle;">If Other, Describe</th>
                                                                    <th style="vertical-align: middle;">Acquisition Date</th>
                                                                    <th style="vertical-align: middle;">Percentage Owned</th>
                                                                    <th style="vertical-align: middle;">Market Value</th>
                                                                    <th style="vertical-align: middle;">Comments</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                   
                                                                <tr>
                                                                    <td></td>
                                                                  
                                                                </tr>
                                                         
                                                            </tbody>
                                                        </table>
                                                       
                                                            <div class="text-right">
                                                            
                                                            </div>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                             <!-- end Real Estate -->


                                            <!-- start Securities -->
                                            <div role="tabpanel" class="tab-pane" id="securities">
                                                <div class="right_dis_table">
                                                    <h6>Securities</h6>
                                                    <div class="padding_0 endosment_table table-responsive">
                                                        <table id="example3" class="table table-bordered" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr style="vertical-align: middle;">
                                                                    <th style="vertical-align: middle;">Issuing Entity</th>
                                                                    <th style="vertical-align: middle;">Type of Security</th>
                                                                    <th style="vertical-align: middle;">Market Value</th>
                                                                    <th style="vertical-align: middle;">Percentage Ownership</th>
                                                                    <th style="vertical-align: middle;">Owns Real Estate</th>
                                                                    <th style="vertical-align: middle;">Owns Securities</th>
                                                                    <th style="vertical-align: middle;">Held in Trust</th>
                                                                    <th style="vertical-align: middle;">Comments</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                        
                                                                <tr>
                                                                    <td></td>
                                                               
                                                                </tr>
                                                               
                                                            </tbody>
                                                        </table>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                             <!-- end Securities -->

                                            <!-- start Trusts -->
                                            <div role="tabpanel" class="tab-pane" id="trust">
                                                <div class="right_dis_table">
                                                    <h6>Trusts</h6>
                                                    <div class="padding_0 endosment_table table-responsive">
                                                        <table id="example3" class="table table-bordered" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr style="vertical-align: middle;">
                                                                    <th style="vertical-align: middle;">Identify of Beneficiary</th>
                                                                    <th style="vertical-align: middle;">Nature of Beneficiary</th>
                                                                    <th style="vertical-align: middle;">Value of Beneficial Interest</th>
                                                                    <th style="vertical-align: middle;">Contents of Trust</th>
                                                                    <th style="vertical-align: middle;">Comments</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                         
                                                                <tr>
                                                                    <td></td>
                                                                   
                                                                </tr>
                                                              
                                                            </tbody>
                                                        </table>
                                                       
                                                            <div class="text-right">
                                                             
                                                            </div>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                             <!-- end Trusts -->

                                             <!-- start Relatives -->
                                             <div role="tabpanel" class="tab-pane" id="relatives">
                                                <div class="right_dis_table">
                                                    <h6>Relatives</h6>
                                                    <div class="padding_0 endosment_table table-responsive">
                                                        <table id="example3" class="table table-bordered" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr style="vertical-align: middle;">
                                                                    <th style="vertical-align: middle;">Name</th>
                                                                    <th style="vertical-align: middle;">Agency Name</th>
                                                                    <th style="vertical-align: middle;">Title</th>
                                                                    <th style="vertical-align: middle;">Position</th>
                                                                    <th style="vertical-align: middle;">Relationship to Filer</th>
                                                                    <th style="vertical-align: middle;">Comments</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                           
                                                                <tr>
                                                                    <td></td>
                                                                    
                                                               
                                                            </tbody>
                                                        </table>
                                                      
                                                            <div class="text-right">
                                                              
                                                            </div>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                             <!-- end Relatives -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="2016" style="padding: 0px;">
                            <div class="inner_disclosure">
                                <div class="col-sm-12">
                                    <div class="row inner_dis_row">
                                        <div class="tab-content all_year_list">
                                            <!-- start general info -->
                                            <div role="tabpanel" class="tab-pane active" id="general_info">
                                                <div class="right_dis_table">
                                                    <h6>General Info</h6>
                                                    <div class="padding_0 endosment_table table-responsive">
                                                        <table id="example3" class="table table-bordered" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th style="text-align: left;">Question text</th>
                                                                    <th style="width: 20%;">Answer</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td style="text-align: left;">Question</td>
                                                                    <td>Answer</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: left;">Blabh blah blah</td>
                                                                    <td>Yes</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end general info -->
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
<script>
$(document).ready(function() {
    $('#example1').DataTable();
    $('#example2').DataTable();
    $('#example3').DataTable();
} );
</script>

@include('layouts.script')
@endsection
