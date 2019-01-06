@extends('layouts.app')
@section('title', 'Laws')

@section('content')
<script>
    $(function () {
        $("#buttonID").css("margin-top", ($("#divID").height() - $("#buttonID").height() - $("#buttonID").height()) + "px");
    });
</script>

<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="page-title row">
            <div class="pull-left">{{$laws->title}}</div>
        </div>
        <div class="menu-bar row">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="about">
                    <div class="box" id="divID" style="padding: 40px;border-top: 2px solid #d2d6de;">
                        <div class="row">
                            <div class="col-md-8" style="padding-top: 5px;">
                                <p>The New York City Council creates the laws that govern the city. These laws can change the city charter, administrative code and agency rules, affecting how agencies operate.</p>
                                <div class="row  text-center" id="buttonID">
                                    <div class="col-md-4">
                                        <a href="https://council.nyc.gov" target="_blank"><button type="button" class="btn btn-raised btn-info">City Council Website</button></a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="https://laws.council.nyc.gov" target="_blank"><button type="button" class="btn btn-raised btn-info">Legislation Tracking App</button></a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/organization_170010102" target="_blank"><button type="button" class="btn btn-raised btn-info">MyGov Agency Profile</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h3 class="box-title" style="margin: 16px 0;">Events (<a href="https://laws.council.nyc.gov/events/" target="_blank">Go to Calendar</a>)</h3>
                                   <iframe src="https://feed.mikle.com/widget/v2/95922/" height="256px" width="100%" class="fw-iframe" scrolling="no" frameborder="0" style="height: 175px;"></iframe>       
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box" style="padding: 40px;border-top: 2px solid #d2d6de;min-height: 345px;">
                                <div class="row">
                                    <div class="col-md-12" style="padding-top: 5px;">
                                    <p>{!! $laws->body !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         @include('partials.footer')
    </div>

</div>
@include('layouts.script')
@endsection
