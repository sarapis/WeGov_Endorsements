@extends('layouts.app')
@section('title', 'Data')

@section('content')


<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="page-title row">
            <div class="pull-left">{{$datas->title}}</div>
        </div>
        <div class="menu-bar row">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="about">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box" style="padding: 40px;border-top: 2px solid #d2d6de;min-height: 345px;">
                                <div class="row">
                                    <div class="col-md-12" style="padding-top: 5px;">
                                    <p>{!! $datas->body !!}</p>
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
