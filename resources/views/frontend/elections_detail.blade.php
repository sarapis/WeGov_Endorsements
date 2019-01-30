@extends('layouts.app')
@section('title', 'Agencies and Departments')
@section('content')

<div class="demo-container mdl-grid inner_organization people_content_inner">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <!-- start elections contentbar -->
                        <div class="row">
                            <div class="col-sm-12 election_menu detail_elec">
                                <div class="col-sm-12">
                                    <div class="box padding_0">
                                        <div class="box-header">
                                            <h3 class="box-title"><a href="#">2017 Primary</a></h3>
                                            <p><i class="fas fa-calendar-alt"></i> Election Day:  9/2/2017</p>
                                        </div>
                                        <div class="box-body">
                                            <p>This cycle includes state senate, state assembly, NYC council, mayor, comptroller and Public Advocate.</p>
                                            <h5><span>80</span>Offices</h5>
                                            <h5><span>384</span>Candidates</h5>
                                            <h5><span>1034</span>Endorsements</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 election_menu">
                                <div class="col-sm-4">
                                    <div class="box padding_0">
                                        <div class="box-header">
                                            <h3 class="box-title"><a href="#">City</a></h3>
                                        </div>
                                        <div class="box-body">
                                            <div class="candidate_detail">
                                                <ul>
                                                    <li><span>Mayor  - <em>9 candidates</em></span></li>
                                                    <li><span>Public Advocate - <em>3 candidates</em></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="box padding_0">
                                        <div class="box-header">
                                            <h3 class="box-title"><a href="#">State</a></h3>
                                        </div>
                                        <div class="box-body">
                                            <div class="candidate_detail">
                                                <ul>
                                                    <li><span>Mayor  - <em>9 candidates</em></span></li>
                                                    <li><span>Public Advocate - <em>3 candidates</em></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="box padding_0">
                                        <div class="box-header">
                                            <h3 class="box-title"><a href="#">Federal</a></h3>
                                        </div>
                                        <div class="box-body">
                                            <div class="candidate_detail">
                                                <ul>
                                                    <li><span>Office Name - <em>9 candidates</em></span></li>
                                                    <li><span>Public Advocate - <em>3 candidates</em></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end elections contentbar -->
    </div>

</div>

@include('layouts.script')
@endsection
