@extends('layouts.app')
@section('title', 'Home')

@section('content')


<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="page-title row">
            <div class="pull-left">{{$posts->title}}</div>
        </div>
        <div class="menu-bar row">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="about">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box" style="padding: 40px;border-top: 2px solid #d2d6de;">
                                <div class="row">
                                    <div class="col-md-8" style="padding-top: 5px;">
                                        <p>{!! $posts->body !!}</p>
                                    </div>
                                    <div class="col-md-4">
                                       
                                            <img src="{{asset('images/logo.png')}}" class="img-responsive">
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box">
                                        <div class="box-header"><h3 class="box-title">Acitivities</h3></div>
                                        <div class="box-body">
                                            <div class="row" style="padding: 40px;">
                                                <div class="col-sm-6">
                                                    <h5 class="box-body-operating"> Services</h5>
                                                    <h3 class="box-body-operating"><b>{{number_format($quantity_services)}}</b></h3>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h5 class="box-body-operating">Projects</h5>
                                                    <h3 class="box-body-operating"><b>{{$quantity_project}}</b></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="box">
                                        <div class="box-header"><h3 class="box-title">Budgets</h3></div>
                                        <div class="box-body">
                                            <div class="row" style="padding: 40px;">
                                                <div class="col-sm-6">
                                                    <h5 class="box-body-budget">Expense</h5>
                                                    <h3 class="box-body-budget"><b>${{$budgets}}</b></h3>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h5 class="box-body-budget">Capital</h5>
                                                    <h3 class="box-body-budget"><b>${{$capital}}</b></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box" style="padding: 40px;border-top: 2px solid #d2d6de;">
                        <div class="row">
                            <div class="col-md-12" style="padding-top: 5px;">
                            <p>{!! $posts->bottom !!}</p>
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
