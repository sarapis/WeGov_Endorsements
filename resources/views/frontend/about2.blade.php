@extends('layouts.app')
@section('title', 'About')

@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
    	<div class="page-title row">
	    	<div class="pull-right hidden-xs" style="padding-left: 20px;">
		      <p class="text-title-tages">Public Safely</p>
		    </div>
		    <div class="pull-right hidden-xs">
		      <p class="text-title-tages">NYPD</p>
		    </div>
        	<div class="pull-left">New York City Police Department</div>
        </div>
        <div class="menu-bar row">

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#about" aria-controls="about" role="tab" data-toggle="tab" class="menu-title">ABOUT</a></li>
                <li role="presentation"><a href="#projects" aria-controls="projects" role="tab" data-toggle="tab">PROJECTS</a></li>
                <li role="presentation"><a href="#services" aria-controls="messages" role="tab" data-toggle="tab">SERVICES</a></li>
                <li role="presentation"><a href="#money" aria-controls="money" role="tab" data-toggle="tab">MONEY</a></li>
                <li role="presentation"><a href="#people" aria-controls="people" role="tab" data-toggle="tab">PEOPLE</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="about">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="box" style="padding: 40px;border-top: 2px solid #d2d6de;">
                                <div class="row">
                                    <div class="col-md-7">
                                    <p>The Police Department (NYPD) is committed to providing, with the utmost integrity and respect, a safe and secure environment for the public.</p>
                                    </div>
                                    <div class="col-md-5"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box">
                                        <div class="box-header"><h3 class="box-title">Operating Acitivities</h3></div>
                                        <div class="box-body">
                                            <div class="row" style="padding: 70px;">
                                                <div class="col-sm-6">
                                                    <h4 class="box-body-operating">NYC Services</h4>
                                                    <h1 class="box-body-operating"><b>0</b></h1>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="box-body-operating">Capital Projects</h4>
                                                    <h1 class="box-body-operating"><b>82</b></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="box">
                                        <div class="box-header"><h3 class="box-title">Total Budgets</h3></div>
                                        <div class="box-body">
                                            <div class="row" style="padding: 70px;">
                                                <div class="col-sm-6">
                                                    <h4 class="box-body-budget">Expense Budget</h4>
                                                    <h1 class="box-body-budget"><b>$5.38 B</b></h1>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="box-body-budget">Capital Budgets</h4>
                                                    <h1 class="box-body-budget"><b>$1.18 B</b></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box" style="border-top: 2px solid #d2d6de;">
                                <div id="mymap" style="width: 100%; height: 400px;"></div>
                                <div class="box-footer text-center" style="height: 115px;">
                                    <a class="btn btn-app btn-link">
                                        <i class="fa md md-phone"></i> Call
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a class="btn btn-app btn-link">
                                        <i class="fa md md-place"></i> Location
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a class="btn btn-app btn-link">
                                        <i class="fa md md-link"></i> Edit
                                        <div class="ripple-container"></div>
                                    </a>
                                    <a class="btn btn-app btn-link">
                                        <i class="fa md md-publish"></i> Share
                                        <div class="ripple-container"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="box text-center" style="min-height: 390px;">
                                <p class="text-feed">Twitter feed</p>
                                <button class="btn btn-tweet">Tweet at NYPD</button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box text-center" style="min-height: 390px;">
                                <p class="text-feed">Facebook feed</p>
                                <button class="btn btn-facebook">Follow NYPD</button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="box text-center" style="min-height: 390px;">
                                <p class="text-feed">RSS Feed</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="projects">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
                <div role="tabpanel" class="tab-pane" id="money">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                <div role="tabpanel" class="tab-pane" id="services">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passage..</div>
                <div role="tabpanel" class="tab-pane" id="people">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passage..</div>
            </div>
        </div>
         @include('partials.footer')
    </div>

</div>

@endsection
