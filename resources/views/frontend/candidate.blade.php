@extends('layouts.app')
@section('title', 'Candidate')
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
                <div class="pull-left org_title">{{$politician->name}}</div><br/>
                <div class="pull-left people_title_org"> @if($politician->elected_to) <a href="/organization_{{$politician->elected->organizationid}}">{{$politician->elected->organization}}</a> @endif </div>
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
                                                    <td style="text-align: left;">@if(isset($campaign->office)) <a href="/organization_{{$campaign->organization()->first()->organizationid}}/candidates">{{$campaign->organization()->first()->organization}}</a> @endif</td>
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
                                                <th style="text-align: left;width: 305%;">Office</th>
                                                <th style="text-align: left;width: 30%;">Organization</th>
                                                <th style="text-align: left;">URL</th>
                                                <th style="text-align: center;">Recorded Date</t h>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($endorsements as $endorsement)
                                            <tr>
                                                <td><a href="/elections/{{$endorsement->elections()->first()->year}}">{{$endorsement->elections()->first()->name}}</a></td>
                                                <td style="text-align: left;">@if($endorsement->office) <a href="/organization_{{$endorsement->offices()->first()->organizationid}}/candidates">{{$endorsement->offices()->first()->organization}}</a> @endif</td>
                                                <td style="text-align: left;">@if(isset($endorsement->organizations)) <a href="/organization_{{$endorsement->organization()->first()->organizationid}}/endorsements">{{$endorsement->organization()->first()->organization}}</a> @endif</td>
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
                        <li><a href="#2016" data-toggle="tab">2016</a></li>
                    </ul>
                    <div class="tab-content people_tabpanel">
                        <div role="tabpanel" class="tab-pane active" id="2017" style="padding: 0px;">
                            <div class="inner_disclosure">
                                <div class="col-sm-2">
                                    <ul class="left_dis_menu" role="tablist">
                                        <li class="active"><a href="#general_info" data-toggle="tab">General Info</a></li>
                                        <li><a href="#city_position" data-toggle="tab">City Positions</a></li>
                                        <li><a href="#other_income" data-toggle="tab">Other Income</a></li>
                                        <li><a href="#debts" data-toggle="tab">Debts</a></li>
                                        <li><a href="#real_estate" data-toggle="tab">Real Estate</a></li>
                                        <li><a href="#securities" data-toggle="tab">Securities</a></li>
                                        <li><a href="#trust" data-toggle="tab">Trust</a></li>
                                        <li><a href="#relatives" data-toggle="tab">Relatives</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-10">
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
                                                                    <th  class="text-center" style="width: 10%;">Answer</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td style="text-align: left;">Report For</td>
                                                                    <td class="text-center">{{$politician->name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: left;">Reporting Year</td>
                                                                    <td class="text-center">@if(isset($information_2017->reporting_year)) {{$information_2017->reporting_year}} @endif</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: left;">Is Termination Report</td>
                                                                    <td class="text-center">@if(isset($information_2017->termination_report)) {{$information_2017->termination_report}} @endif</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: left;">Termination Date</td>
                                                                    <td class="text-center">@if(isset($information_2017->termination_date)) {{$information_2017->termination_date}} @endif</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: left;">Reason for Filing</td>
                                                                    <td class="text-center">@if(isset($information_2017->reason_for_filing)) {{$information_2017->reason_for_filing}} @endif</td>
                                                                </tr>
                                                                @foreach($questions as $question)
                                                                <tr>
                                                                    <td style="text-align: left;">{{$question->notes}}</td>
                                                                    <td class="text-center">@if(isset($information_2017['info'.$question->question_id])) {{$information_2017['info'.$question->question_id]}} @endif</td>
                                                                </tr>
                                                                @endforeach
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
                                                                @foreach($position_2017 as $position)
                                                                <tr>
                                                                    <td>{{$position->current_final_agency}}</td>
                                                                    <td>{{$position->status}}</td>
                                                                    <td>{{$position->borough}}</td>
                                                                    <td>{{$position->district}}</td>
                                                                    <td>{{$position->address}}</td>
                                                                    <td>{{$position->telephone}}</td>
                                                                    <td>{{$position->position_title}}</td>
                                                                    <td>{{$position->nature_of_income}}</td>
                                                                    <td>{{$position->income}}</td>
                                                                    <td>{{$position->comments}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
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
                                                                @foreach($incomes_2017 as $income)
                                                                <tr>
                                                                    <td>{{$income->source_of_income}}</td>
                                                                    <td>{{$income->amount_of_income}}</td>
                                                                    <td>{{$income->nature_of_income}}</td>
                                                                    <td>{{$income->comments}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
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
                                                                @foreach($depts_2017 as $dept)
                                                                <tr>
                                                                    <td>{{$dept->name_of_creditor}}</td>
                                                                    <td>{{$dept->type_of_loan}}</td>
                                                                    <td>{{$dept->other_liability}}</td>
                                                                    <td>{{$dept->nature_of_collateral}}</td>
                                                                    <td>{{$dept->number_of_guarantor}}</td>
                                                                    <td>{{$dept->amount_owed}}</td>
                                                                    <td>{{$dept->comments}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
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
                                                                @foreach($realestates_2017 as $realestate)
                                                                <tr>
                                                                    <td>{{$realestate->address}}</td>
                                                                    <td>{{$realestate->size_of_property}}</td>
                                                                    <td>{{$realestate->nature_of_property}}</td>
                                                                    <td>{{$realestate->describe}}</td>
                                                                    <td>{{$realestate->acquisition_date}}</td>
                                                                    <td>{{$realestate->percentage}}</td>
                                                                    <td>{{$realestate->market_value}}</td>
                                                                    <td>{{$realestate->comments}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                      
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
                                                                @foreach($securities_2017 as $security)
                                                                <tr>
                                                                    <td>{{$security->issuing_entity}}</td>
                                                                    <td>{{$security->type_of_security}}</td>
                                                                    <td>{{$security->market_value}}</td>
                                                                    <td>{{$security->percent}}</td>
                                                                    <td>{{$security->owns_real_estate}}</td>
                                                                    <td>{{$security->owns_securites}}</td>
                                                                    <td>{{$security->held}}</td>
                                                                    <td>{{$security->comments}}</td>
                                                                </tr>
                                                                @endforeach
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
                                                                @foreach($trusts_2017 as $trust)
                                                                <tr>
                                                                    <td>{{$trust->identify}}</td>
                                                                    <td>{{$trust->nature_of_beneficial}}</td>
                                                                    <td>{{$trust->value_of_beneficial}}</td>  
                                                                    <td>{{$trust->contents}}</td>  
                                                                    <td>{{$trust->comments}}</td>  
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                      
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
                                                                @foreach($relatives_2017 as $relative)
                                                                <tr>
                                                                    <td>{{$relative->name}}</td>
                                                                    <td>{{$relative->agency_name}}</td>
                                                                    <td>{{$relative->title}}</td>
                                                                    <td>{{$relative->position}}</td>
                                                                    <td>{{$relative->relationship}}</td>
                                                                    <td>{{$relative->comments}}</td>
                                                                </tr>   
                                                                @endforeach
                                                            </tbody>
                                                        </table>
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
                                <div class="col-sm-2">
                                    <ul class="left_dis_menu" role="tablist">
                                        <li class="active"><a href="#general_info_2016" data-toggle="tab">General Info</a></li>
                                        <li><a href="#city_position_2016" data-toggle="tab">City Positions</a></li>
                                        <li><a href="#other_income_2016" data-toggle="tab">Other Income</a></li>
                                        <li><a href="#debts_2016" data-toggle="tab">Debts</a></li>
                                        <li><a href="#real_estate_2016" data-toggle="tab">Real Estate</a></li>
                                        <li><a href="#securities_2016" data-toggle="tab">Securities</a></li>
                                        <li><a href="#trust_2016" data-toggle="tab">Trust</a></li>
                                        <li><a href="#relatives_2016" data-toggle="tab">Relatives</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-10">
                                    <div class="row inner_dis_row">
                                        <div class="tab-content all_year_list">
                                            <!-- start general info -->
                                            <div role="tabpanel" class="tab-pane active" id="general_info_2016">
                                                <div class="right_dis_table">
                                                    <h6>General Info</h6>
                                                    <div class="padding_0 endosment_table table-responsive">
                                                        <table id="example3" class="table table-bordered" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th style="text-align: left;">Question text</th>
                                                                    <th  class="text-center" style="width: 10%;">Answer</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td style="text-align: left;">Report For</td>
                                                                    <td class="text-center">{{$politician->name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: left;">Reporting Year</td>
                                                                    <td class="text-center">@if(isset($information_2016->reporting_year)) {{$information_2016->reporting_year}} @endif</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: left;">Is Termination Report</td>
                                                                    <td class="text-center">@if(isset($information_2016->termination_report)) {{$information_2016->termination_report}} @endif</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: left;">Termination Date</td>
                                                                    <td class="text-center">@if(isset($information_2016->termination_date)) {{$information_2016->termination_date}} @endif</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: left;">Reason for Filing</td>
                                                                    <td class="text-center">@if(isset($information_2016->reason_for_filing)) {{$information_2016->reason_for_filing}} @endif</td>
                                                                </tr>
                                                                @foreach($questions as $question)
                                                                <tr>
                                                                    <td style="text-align: left;">{{$question->notes}}</td>
                                                                    <td class="text-center">@if(isset($information_2016['info'.$question->question_id])) {{$information_2016['info'.$question->question_id]}} @endif</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end general info -->

                                            <!-- start city position -->
                                            <div role="tabpanel" class="tab-pane" id="city_position_2016">
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
                                                                @foreach($position_2016 as $position)
                                                                <tr>
                                                                    <td>{{$position->current_final_agency}}</td>
                                                                    <td>{{$position->status}}</td>
                                                                    <td>{{$position->borough}}</td>
                                                                    <td>{{$position->district}}</td>
                                                                    <td>{{$position->address}}</td>
                                                                    <td>{{$position->telephone}}</td>
                                                                    <td>{{$position->position_title}}</td>
                                                                    <td>{{$position->nature_of_income}}</td>
                                                                    <td>{{$position->income}}</td>
                                                                    <td>{{$position->comments}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                             <!-- end city position -->

                                            <!-- start Other Incomes -->
                                            <div role="tabpanel" class="tab-pane" id="other_income_2016">
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
                                                                @foreach($incomes_2016 as $income)
                                                                <tr>
                                                                    <td>{{$income->source_of_income}}</td>
                                                                    <td>{{$income->amount_of_income}}</td>
                                                                    <td>{{$income->nature_of_income}}</td>
                                                                    <td>{{$income->comments}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end Other Incomes -->

                                            <!-- start Debts -->
                                            <div role="tabpanel" class="tab-pane" id="debts_2016">
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
                                                                @foreach($depts_2016 as $dept)
                                                                <tr>
                                                                    <td>{{$dept->name_of_creditor}}</td>
                                                                    <td>{{$dept->type_of_loan}}</td>
                                                                    <td>{{$dept->other_liability}}</td>
                                                                    <td>{{$dept->nature_of_collateral}}</td>
                                                                    <td>{{$dept->number_of_guarantor}}</td>
                                                                    <td>{{$dept->amount_owed}}</td>
                                                                    <td>{{$dept->comments}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end Debts -->

                                            <!-- start Real Estate -->
                                            <div role="tabpanel" class="tab-pane" id="real_estate_2016">
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
                                                                @foreach($realestates_2016 as $realestate)
                                                                <tr>
                                                                    <td>{{$realestate->address}}</td>
                                                                    <td>{{$realestate->size_of_property}}</td>
                                                                    <td>{{$realestate->nature_of_property}}</td>
                                                                    <td>{{$realestate->describe}}</td>
                                                                    <td>{{$realestate->acquisition_date}}</td>
                                                                    <td>{{$realestate->percentage}}</td>
                                                                    <td>{{$realestate->market_value}}</td>
                                                                    <td>{{$realestate->comments}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                             <!-- end Real Estate -->

                                            <!-- start Securities -->
                                            <div role="tabpanel" class="tab-pane" id="securities_2016">
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
                                                                @foreach($securities_2016 as $security)
                                                                <tr>
                                                                    <td>{{$security->issuing_entity}}</td>
                                                                    <td>{{$security->type_of_security}}</td>
                                                                    <td>{{$security->market_value}}</td>
                                                                    <td>{{$security->percent}}</td>
                                                                    <td>{{$security->owns_real_estate}}</td>
                                                                    <td>{{$security->owns_securites}}</td>
                                                                    <td>{{$security->held}}</td>
                                                                    <td>{{$security->comments}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                             <!-- end Securities -->

                                            <!-- start Trusts -->
                                            <div role="tabpanel" class="tab-pane" id="trust_2016">
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
                                                                @foreach($trusts_2016 as $trust)
                                                                <tr>
                                                                    <td>{{$trust->identify}}</td>
                                                                    <td>{{$trust->nature_of_beneficial}}</td>
                                                                    <td>{{$trust->value_of_beneficial}}</td>  
                                                                    <td>{{$trust->contents}}</td>  
                                                                    <td>{{$trust->comments}}</td>  
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end Trusts -->

                                            <!-- start Relatives -->
                                            <div role="tabpanel" class="tab-pane" id="relatives_2016">
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
                                                                @foreach($relatives_2016 as $relative)
                                                                <tr>
                                                                    <td>{{$relative->name}}</td>
                                                                    <td>{{$relative->agency_name}}</td>
                                                                    <td>{{$relative->title}}</td>
                                                                    <td>{{$relative->position}}</td>
                                                                    <td>{{$relative->relationship}}</td>
                                                                    <td>{{$relative->comments}}</td>
                                                                </tr>   
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end Relatives -->

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
    // $('#example3').DataTable();
} );
</script>
@endsection










