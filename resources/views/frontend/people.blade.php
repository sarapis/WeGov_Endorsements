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
                <div class="pull-right">
                    <p class="text-tages"> Tags: <span class="badge bg-blue">Republican</span></p>
                </div>
                <div class="pull-right" style="padding-left: 20px;padding-right: 10px;">
                    <p class="text-types"> Type: 
                        <span class="badge bg-blue">Politician </span>
                    </p>
                </div>
                <div class="pull-left org_title">{{ $contact->first_name }}, {{ $contact->last_name }}</div><br/>
                <div class="pull-left people_title_org">{{ $contact->office_title }}, {{ $contact->organization_name ? $contact->organization_name : '' }} {{ $contact->organization_name && $contact->division_name ? ' +' : '' }} {{ $contact->division_name }}</div>
                <div class="social_icon">
                    <ul>
                        <li><a href="#" title="Website"><i class="fas fa-globe"></i></a></li>
                        <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" title="RSS"><i class="fas fa-rss"></i></a></li>
                        <li><a href="#" title="Phone"><i class="fas fa-phone"></i></a></li>
                        <li><a href="#" title="Email"><i class="fas fa-envelope"></i></a></li>
                        <li><a href="#" title="Address"><i class="fas fa-map-marker-alt"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="menu-bar row">
            <ul class="nav nav-tabs desktop_tab" role="tablist">
                <li class="active"><a href="#people_contact" class="menu-title" data-toggle="tab" >CONTACT</a></li>
                <li><a href="#people_campaigns" data-toggle="tab" >CAMPAIGNS</a></li>
                <li><a href="#people_endorsement" data-toggle="tab" >ENDORSEMENTS</a></li>
                <li><a href="#people_disclouser" data-toggle="tab" >DISCLOSURES</a></li>
            </ul>

            <button type="button" class="btn btn-raised btn-block btn-primary org_filter">Organization Filter </button>

            <div class="tab_filter_btn">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#people_contact" class="menu-title" data-toggle="tab" >CONTACT</a></li>
                    <li><a href="#people_campaigns" data-toggle="tab" >CAMPAIGNS</a></li>
                    <li><a href="#people_endorsement" data-toggle="tab" >ENDORSEMENTS</a></li>
                    <li><a href="#people_disclouser" data-toggle="tab" >DISCLOSURES</a></li>
                </ul>
            </div>
             <div class="tab-content people_tabpanel">
                <div role="tabpanel" class="tab-pane active" id="people_contact">
                    <div class="row">
                        <div class="col-sm-4 address">
                            <div class="box">
                                <i class="fas fa-map-marker-alt"></i>
                                <h5>Address</h5>
                                <p>{{ $contact->address }}<br/>{{ $contact->city }}, {{ $contact->state_province }} {{ $contact->postal_code }}</p>
                            </div>
                        </div>
                        <div class="col-sm-4 address">
                            <div class="box">
                                <i class="fas fa-phone"></i>
                                <h5>Phone</h5>
                                <p>Agency Phone: {{ $contact->agency_primary_phone }} <br/>Division Phone: {{ $contact->division_primary_phone }}</p>
                            </div>
                        </div>
                        <div class="col-sm-4 address">
                            <div class="box">
                                <i class="fas fa-fax"></i>
                                <h5>Fax</h5>
                                <p>Fax Number: {{ $contact->fax_1 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="people_campaigns">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box padding_0 table_data">
                                <div class="padding_0 endosment_table table-responsive">
                                    <table id="example3" class="table table-bordered" cellspacing="0" width="100%" style="margin-bottom: 20px  !important; ">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;width: 15%;">Election</th>
                                                <th style="text-align: left;">Office</th>
                                                <th style="text-align: left;width: 15%;">Party</th>
                                                <th style="text-align: left;">Website</th>
                                                <th style="text-align: center;width: 10%;">Outcome</th>
                                                <th style="text-align: center;width: 10%;">Endorsements</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($campaingn) > 0)
                                            @foreach($campaingn as $key => $value)
                                                <tr>
                                                    <td>{{$value->election}}</td>
                                                    <td style="text-align: left;">{{$value->office}}</td>
                                                    <td style="text-align: left;">{{$value->parties}}</td>
                                                    <td style="text-align: left;"><a href="#"></a></td>
                                                    <td></td>
                                                    <td>{{$value->endorsements}}</td>
                                                </tr>
                                            @endforeach
                                            @endif
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
                                    <table id="example3" class="table table-bordered" cellspacing="0" width="100%" style="margin-bottom: 20px  !important; ">
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
                                            <tr>
                                                <td>2017 General</td>
                                                <td style="text-align: left;">Mayor</td>
                                                <td style="text-align: left;">South Bronx Development Corp</td>
                                                <td style="text-align: left;"><a href="#">skdaskjaslkd.com</a></td>
                                                <td>5/19/17</td>
                                            </tr>
                                            <tr>
                                                <td>2017 Primary</td>
                                                <td style="text-align: left;">Mayor</td>
                                                <td style="text-align: left;">South Bronx Development Corp</td>
                                                <td style="text-align: left;"><a href="#">skdaskjaslkd.com</a></td>
                                                <td>5/19/17</td>
                                            </tr>
                                            <tr>
                                                <td>2017 General</td>
                                                <td style="text-align: left;">Mayor</td>
                                                <td style="text-align: left;">South Bronx Development Corp</td>
                                                <td style="text-align: left;"><a href="#">skdaskjaslkd.com</a></td>
                                                <td>5/19/17</td>
                                            </tr>
                                            <tr>
                                                <td>2017 Primary</td>
                                                <td style="text-align: left;">Mayor</td>
                                                <td style="text-align: left;">South Bronx Development Corp</td>
                                                <td style="text-align: left;"><a href="#">skdaskjaslkd.com</a></td>
                                                <td>5/19/17</td>
                                            </tr>
                                            <tr>
                                                <td>2017 General</td>
                                                <td style="text-align: left;">Mayor</td>
                                                <td style="text-align: left;">South Bronx Development Corp</td>
                                                <td style="text-align: left;"><a href="#">skdaskjaslkd.com</a></td>
                                                <td>5/19/17</td>
                                            </tr>
                                            <tr>
                                                <td>2017 Primary</td>
                                                <td style="text-align: left;">Mayor</td>
                                                <td style="text-align: left;">South Bronx Development Corp</td>
                                                <td style="text-align: left;"><a href="#">skdaskjaslkd.com</a></td>
                                                <td>5/19/17</td>
                                            </tr>
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
                                                            @if(count($realYear[2017]['cityPosition']) > 0)
                                                            @foreach ($realYear[2017]['cityPosition'] as $key => $value)
                                                                <tr>
                                                                    <td>{{$value->current_final_agency}}</td>
                                                                    <td>{{$value->status}}</td>
                                                                    <td>{{$value->borough}}</td>
                                                                    <td>{{$value->district}}</td>
                                                                    <td>{{$value->address}}</td>
                                                                    <td>{{$value->telephone}}</td>
                                                                    <td>{{$value->position_title}}</td>
                                                                    <td>{{$value->nature_of_income}}</td>
                                                                    <td>{{$value->income}}</td>
                                                                    <td>{{$value->comments}}</td>
                                                                </tr>
                                                                @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                        @if(count($realYear[2017]['cityPosition']) > 0)
                                                        <div class="text-right">
                                                            {{$realYear[2017]['cityPosition']->links()}}
                                                        </div>
                                                        @endif
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
                                                                @if(count($realYear[2017]['otherIncome']) > 0)
                                                                @foreach ($realYear[2017]   ['otherIncome'] as $key => $value)
                                                                <tr>
                                                                    <td>{{$value->source_of_income}}</td>
                                                                    <td>{{$value->amount_of_income}}</td>
                                                                    <td>{{$value->nature_of_income}}</td>
                                                                    <td>{{$value->nature_of_income}}</td>
                                                                </tr>
                                                                @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                        @if(count($realYear[2017]['otherIncome']) > 0)
                                                            <div class="text-right">
                                                                {{$realYear[2017]['otherIncome']->links()}}
                                                            </div>
                                                        @endif
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
                                                            @if(count($realYear[2017]['debts']) > 0)
                                                                @foreach ($realYear[2017]   ['debts'] as $key => $value)
                                                                <tr>
                                                                    <td>{{$value->name_of_creditor}}</td>
                                                                    <td>{{$value->type_of_loan}}</td>
                                                                    <td>{{$value->other_liability}}</td>
                                                                    <td>{{$value->nature_of_collateral}}</td>
                                                                    <td>{{$value->name_of_guarantor}}</td>
                                                                    <td>{{$value->amount_owed}} </td>
                                                                    <td>{{$value->comments}}</td>
                                                                </tr>
                                                                @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                        @if(count($realYear[2017]['debts']) > 0)
                                                            <div class="text-right">
                                                                {{$realYear[2017]['debts']->links()}}
                                                            </div>
                                                        @endif
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
                                                            @if(count($realYear[2017]['realEstate']) > 0)
                                                                @foreach ($realYear[2017]   ['realEstate'] as $key => $value)
                                                                <tr>
                                                                    <td>{{$value->address}}</td>
                                                                    <td>{{$value->size_of_property}}</td>
                                                                    <td>{{$value->nature_of_property}}</td>
                                                                    <td>{{$value->describe}}</td>
                                                                    <td>{{$value->acquisition_date}}</td>
                                                                    <td>{{$value->percentage}}</td>
                                                                    <td>{{$value->market_value}}</td>
                                                                    <td>{{$value->comments}}</td>
                                                                </tr>
                                                                @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                        @if(count($realYear[2017]['realEstate']) > 0)
                                                            <div class="text-right">
                                                                {{$realYear[2017]['realEstate']->links()}}
                                                            </div>
                                                        @endif
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
                                                            @if(count($realYear[2017]['securities']) > 0)
                                                                @foreach ($realYear[2017]   ['securities'] as $key => $value)
                                                                <tr>
                                                                    <td>{{$value->issuing_entity}}</td>
                                                                    <td>{{$value->type_of_security}}</td>
                                                                    <td>{{$value->market_value}}</td>
                                                                    <td>{{$value->percent}}</td>
                                                                    <td>{{$value->owns_real_estate}}</td>
                                                                    <td>{{$value->owns_securities}}</td>
                                                                    <td>{{$value->held}}</td>
                                                                    <td>{{$value->comments}}</td>
                                                                </tr>
                                                                @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                        @if(count($realYear[2017]['securities']) > 0)
                                                            <div class="text-right">
                                                                {{$realYear[2017]['securities']->links()}}
                                                            </div>
                                                        @endif
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
                                                            @if(count($realYear[2017]['trust']) > 0)
                                                                @foreach ($realYear[2017]   ['trust'] as $key => $value)
                                                                <tr>
                                                                    <td>{{$value->identify}}</td>
                                                                    <td>{{$value->nature_of_beneficial}}</td>
                                                                    <td>{{$value->value_of_beneficial}}</td>
                                                                    <td>{{$value->contents}}</td>
                                                                    <td>{{$value->comments}}</td>
                                                                </tr>
                                                                @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                        @if(count($realYear[2017]['trust']) > 0)
                                                            <div class="text-right">
                                                                {{$realYear[2017]['trust']->links()}}
                                                            </div>
                                                        @endif
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
                                                            @if(count($realYear[2017]['relatives']) > 0)
                                                                @foreach ($realYear[2017]   ['relatives'] as $key => $value)
                                                                <tr>
                                                                    <td>{{$value->name}}</td>
                                                                    <td>{{$value->agency_name}}</td>
                                                                    <td>{{$value->title}}</td>
                                                                    <td>{{$value->position}}</td>
                                                                    <td>{{$value->relationship}}</td>
                                                                    <td>{{$value->comments}}</td>
                                                                </tr>
                                                                @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                        @if(count($realYear[2017]['relatives']) > 0)
                                                            <div class="text-right">
                                                                {{$realYear[2017]['relatives']->links()}}
                                                            </div>
                                                        @endif
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

@include('layouts.script')
@endsection
