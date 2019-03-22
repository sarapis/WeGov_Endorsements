@extends('layouts.app')
@section('title', 'Laws')

@section('content')
<script>
    $(function () {
        $("#buttonID").css("margin-top", ($("#divID").height() - $("#buttonID").height() - $("#buttonID").height()) + "px");
    });
</script>

<div class="demo-container mdl-grid inner_organization">
    <div class="demo-content election_menu mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col " style="padding: 0px;">
        <div class="box padding_0" style="box-shadow:none; border: none;">
            <div class="box-header">
                <h3 class="box-title">{{$laws->title}}</h3>
            </div>
            <div class="box-body inner_request_detail">
                <div class="row">
                    <div class="">
                        <div role="tabpanel" class="tab-pane active" id="about">
                            <div class="box" id="divID" style="padding: 20px; margin-bottom: 20px;">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>The New York City Council creates the laws that govern the city. These laws can change the city charter, administrative code and agency rules, affecting how agencies operate.</p>
                                        <div class="row" id="buttonID">
                                            <a href="https://council.nyc.gov" target="_blank"><button type="button" class="btn btn-raised btn-info">City Council Website</button></a>
                                            <a href="https://laws.council.nyc.gov" target="_blank"><button type="button" class="btn btn-raised btn-info">Legislation Tracking App</button></a>
                                            <a href="/organization_170010102" target="_blank"><button type="button" class="btn btn-raised btn-info">MyGov Agency Profile</button></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h4 class="box-title">Events (<a href="https://laws.council.nyc.gov/events/" target="_blank">Go to Calendar</a>)</h4>
                                           <iframe src="https://feed.mikle.com/widget/v2/95922/" height="256px" width="100%" class="fw-iframe" scrolling="no" frameborder="0" style="height: 175px;"></iframe>       
                                    </div>
                                </div>
                            </div>
                            <div class="box" id="divID" style="padding: 20px;">
                                <div style="min-height: 345px;">
                                    <div class="">
                                        <div class="laws_div" style="padding-top: 5px;">
                                            <p>{!! $laws->body !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
         <!--@include('partials.footer')-->
    </div>

</div>
@endsection
