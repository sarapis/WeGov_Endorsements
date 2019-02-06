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
                    <p class="text-tages"> Tags: <?php 
                        $tag_names = explode(',', $organization->tags);
                    ?>
                        @foreach($tag_names as $tag_name)
                            @if($tag_name!='')
                            <span class="badge bg-green">{{$tag_name}}</span>
                            @endif
                        @endforeach
                    </p>
                </div>
                <div class="pull-right" style="padding-left: 20px;padding-right: 10px;">
                    <p class="text-types"> Type: 
                        <span class="badge bg-blue">{{$organization->type}}</span>
                    </p>
                </div>
                <div class="pull-left org_title">{{$greenbook_name}}</div><br/>
                <div class="pull-left people_title_org">Title, Organization, Division</div>
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
                <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                <li class="active"><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/endorsements" id="laws_tab">ENDORSEMENTS</a></li>
                <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="legislation_tab">CANDIDATES</a></li>
            </ul>

            <button type="button" class="btn btn-raised btn-block btn-primary org_filter">Organization Filter </button>

            <div class="tab_filter_btn">
                <ul class="nav nav-tabs" role="tablist">
                    <li><a href="/organization_{{$organization->organizations_id}}" class="menu-title">ABOUT</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/projects" id="projects_tab">PROJECTS</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/services" id="services_tab">SERVICES</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/money" id="money_tab">MONEY</a></li>
                    <li class="active"><a href="/organization_{{$organization->organizations_id}}/people" id="peoples_tab">PEOPLE</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/laws" id="laws_tab">CHARTER, CODE & RULES</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/endorsements" id="endorsements_tab">ENDORSEMENTS</a></li>
                    <li><a href="/organization_{{$organization->organizations_id}}/candidates" id="candidates_tab">CANDIDATES</a></li>
                </ul>
            </div>
             <div class="tab-content people_tabpanel">
                <div role="tabpanel" class="tab-pane active" id="people_contact">
                    <div class="row">
                        <div class="col-sm-4 address">
                            <div class="box">
                                <i class="fas fa-map-marker-alt"></i>
                                <h5>Address</h5>
                                <p>9411 Peachtree Street <br/>Minot, ND 58701</p>
                            </div>
                        </div>
                        <div class="col-sm-4 address">
                            <div class="box">
                                <i class="fas fa-phone"></i>
                                <h5>Phone</h5>
                                <p>Agency Phone: 123-456-1234 <br/>Division Phone: 123-456-1456</p>
                            </div>
                        </div>
                        <div class="col-sm-4 address">
                            <div class="box">
                                <i class="fas fa-fax"></i>
                                <h5>Fax</h5>
                                <p>Fax Number: 1-888-473-2963</p>
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
                                                <th style="text-align: left;">Wbsite</th>
                                                <th style="text-align: center;width: 10%;">Outcome</th>
                                                <th style="text-align: center;width: 10%;">Endorsements</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2017 General</td>
                                                <td style="text-align: left;">Mayor</td>
                                                <td style="text-align: left;">Democrat</td>
                                                <td style="text-align: left;"><a href="#">skdaskjaslkd.com</a></td>
                                                <td>Won</td>
                                                <td>1034</td>
                                            </tr>
                                            <tr>
                                                <td>2017 Primary</td>
                                                <td style="text-align: left;">Mayor</td>
                                                <td style="text-align: left;">Democrat</td>
                                                <td style="text-align: left;"><a href="#">skdaskjaslkd.com</a></td>
                                                <td>Won</td>
                                                <td>80</td>
                                            </tr>
                                            <tr>
                                                <td>2017 General</td>
                                                <td style="text-align: left;">Mayor</td>
                                                <td style="text-align: left;">Democrat</td>
                                                <td style="text-align: left;"><a href="#">skdaskjaslkd.com</a></td>
                                                <td>Won</td>
                                                <td>90</td>
                                            </tr>
                                            <tr>
                                                <td>2017 Primary</td>
                                                <td style="text-align: left;">Mayor</td>
                                                <td style="text-align: left;">Democrat</td>
                                                <td style="text-align: left;"><a href="#">skdaskjaslkd.com</a></td>
                                                <td>Won</td>
                                                <td>1000</td>
                                            </tr>
                                            <tr>
                                                <td>2017 General</td>
                                                <td style="text-align: left;">Mayor</td>
                                                <td style="text-align: left;">Democrat</td>
                                                <td style="text-align: left;"><a href="#">skdaskjaslkd.com</a></td>
                                                <td>Won</td>
                                                <td>985</td>
                                            </tr>
                                            <tr>
                                                <td>2017 Primary</td>
                                                <td style="text-align: left;">Mayor</td>
                                                <td style="text-align: left;">Democrat</td>
                                                <td style="text-align: left;"><a href="#">skdaskjaslkd.com</a></td>
                                                <td>Won</td>
                                                <td>1034</td>
                                            </tr>
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
                                                                <tr>
                                                                    <td>Mayor’s office</td>
                                                                    <td>office</td>
                                                                    <td>New York</td>
                                                                    <td>1</td>
                                                                    <td>City Hall</td>
                                                                    <td>212-456-4123</td>
                                                                    <td>Mayor</td>
                                                                    <td>Salary</td>
                                                                    <td>$100,000,00</td>
                                                                    <td>Answer</td>
                                                                </tr>
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
                                                                <tr>
                                                                    <td>Source of Income</td>
                                                                    <td>$100,000,00 - $47,999,99</td>
                                                                    <td>Rental Income</td>
                                                                    <td>Moved out on April 15th ,...</td>
                                                                </tr>
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
                                                                <tr>
                                                                    <td>Wells Fargo</td>
                                                                    <td>Mortgage</td>
                                                                    <td></td>
                                                                    <td>House Residential</td>
                                                                    <td></td>
                                                                    <td>$100,000,00 </td>
                                                                    <td></td>
                                                                </tr>
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
                                                                <tr>
                                                                    <td>Mayor’s</td>
                                                                    <td>office</td>
                                                                    <td>New York</td>
                                                                    <td>1</td>
                                                                    <td>June 24</td>
                                                                    <td>100%</td>
                                                                    <td>$100,000,00  or more</td>
                                                                    <td>Answer</td>
                                                                </tr>
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
                                                                <tr>
                                                                    <td>Mayor’s</td>
                                                                    <td>office</td>
                                                                    <td>New York</td>
                                                                    <td>1</td>
                                                                    <td>June 24</td>
                                                                    <td>100%</td>
                                                                    <td>$100,000,00  or more</td>
                                                                    <td>Answer</td>
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
                                                                    <td>Source of Income</td>
                                                                    <td>Source of Income</td>
                                                                    <td>Source of Income</td>
                                                                    <td>Moved out</td>
                                                                    <td>Moved out</td>
                                                                </tr>
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
                                                                <tr>
                                                                    <td>Mayor</td>
                                                                    <td>Source of Income</td>
                                                                    <td></td>
                                                                    <td>Mayor</td>
                                                                    <td>Moved out</td>
                                                                    <td>Moved out</td>
                                                                </tr>
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
@endsection
