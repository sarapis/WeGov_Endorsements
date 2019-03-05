@extends('layouts.app')
@section('title', 'Home')

@section('content')


<div class="home_bg">
    <div class="container">
        <h4>MyGov.NYC Research Center</h4>
        <h5>We create, collect and connect open datasets together to give you a data-driven view of New York City government.</h5>
    </div>
</div>
<div class="below_home">
    <div class="container">
        <div class="col-sm-12 col-md-12">
            <div class="row">
                <div class="col-sm-6 pull-left">
                    <div class="inner_left_home">
                        <div class="col-sm-2 col-md-2 icon_images_home">
                           <i class="fas fa-landmark"></i> 
                        </div>
                        <div class="col-sm-8 col-md-8 right_home_text">
                            <h4><a href="#">Organizations</a> </h4>
                            <p>The city and state agencies, elected offices and political groups leading New York City</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 pull-left">
                    <div class="inner_left_home">
                        <div class="col-sm-2 col-md-2 icon_images_home">
                           <i class="fas fa-hammer"></i>
                        </div>
                        <div class="col-sm-8 col-md-8 right_home_text">
                            <h4><a href="#">Capital Projects</a> </h4>
                            <p>New York City’s entire capital budget available in open data and organized by agency.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 pull-left">
                    <div class="inner_left_home">
                        <div class="col-sm-2 col-md-2 icon_images_home">
                           <i class="fas fa-concierge-bell"></i>
                        </div>
                        <div class="col-sm-8 col-md-8 right_home_text">
                            <h4><a href="#">City Services</a> </h4>
                            <p>All services the city published in Open Referral format. We’re adding more all the time. </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 pull-left">
                    <div class="inner_left_home">
                        <div class="col-sm-2 col-md-2 icon_images_home">
                           <i class="fas fa-users"></i> 
                        </div>
                        <div class="col-sm-8 col-md-8 right_home_text">
                            <h4><a href="#">People</a>  </h4>
                            <p>Contact information for over 4000 government employees at over 100 city and state agencies.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 pull-left">
                    <div class="inner_left_home">
                        <div class="col-sm-2 col-md-2 icon_images_home">
                           <i class="fas fa-vote-yea"></i> 
                        </div>
                        <div class="col-sm-8 col-md-8 right_home_text">
                            <h4><a href="#">Elections</a></h4>
                            <p>Candidates running for office and the organizations that have endorsed them.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 pull-left">
                    <div class="inner_left_home">
                        <div class="col-sm-2 col-md-2 icon_images_home">
                           <i class="fas fa-gavel"></i>
                        </div>
                        <div class="col-sm-8 col-md-8 right_home_text">
                            <h4><a href="#">Laws</a></h4>
                            <p>Accessible, mobile friendly versions of the city charter, rules and administrative code. </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 last_home_text">
                    <p><i class="fas fa-file-alt"></i> Toward a More Transparent New York City - Do you have ideas for how New York City can offer more useful open data sets? We do too. Tell us your thoughts.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.script')
@endsection
