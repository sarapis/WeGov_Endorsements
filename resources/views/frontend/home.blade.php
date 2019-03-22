@extends('layouts.app')
@section('title', 'Home')

@section('content')


<div class="home_bg">
    <div class="container">
        <h4>{{$post->title}}</h4>
        <h5>{!! $post->body !!}</h5>
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
                            <h4><a href="/organizations">Organizations</a> </h4>
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
                            <h4><a href="/projects">Capital Projects</a> </h4>
                            <p>New York City’s entire capital budget available in open data and organized by agency</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 pull-left">
                    <div class="inner_left_home">
                        <div class="col-sm-2 col-md-2 icon_images_home">
                           <i class="fas fa-concierge-bell"></i>
                        </div>
                        <div class="col-sm-8 col-md-8 right_home_text">
                            <h4><a href="/services">City Services</a> </h4>
                            <p>All health, human and social services the city published in Open Referral format</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 pull-left">
                    <div class="inner_left_home">
                        <div class="col-sm-2 col-md-2 icon_images_home">
                           <i class="fas fa-users"></i> 
                        </div>
                        <div class="col-sm-8 col-md-8 right_home_text">
                            <h4><a href="/people">People</a>  </h4>
                            <p>Contact information for over 4000 government employees at over 100 city and state agencies</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 pull-left">
                    <div class="inner_left_home">
                        <div class="col-sm-2 col-md-2 icon_images_home">
                           <i class="fas fa-vote-yea"></i> 
                        </div>
                        <div class="col-sm-8 col-md-8 right_home_text">
                            <h4><a href="/elections">Elections</a></h4>
                            <p>Candidates running for office and the organizations that have endorsed them</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 pull-left">
                    <div class="inner_left_home">
                        <div class="col-sm-2 col-md-2 icon_images_home">
                           <i class="fas fa-gavel"></i>
                        </div>
                        <div class="col-sm-8 col-md-8 right_home_text">
                            <h4><a href="/laws">Laws</a></h4>
                            <p>Accessible, mobile friendly versions of the city charter, rules and administrative code </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 last_home_text">
                    <p><!-- <i class="fas fa-file-alt"></i> --> {!! $post->bottom !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
