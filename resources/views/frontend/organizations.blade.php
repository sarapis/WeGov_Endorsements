@extends('layouts.app')
@section('title', 'Agencies and Departments')

@section('content')


<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col" style="padding-top: 0;">
        <div class="col-sm-3" style="border-right: 1px solid #3f3f3f; height: 100%;">
            <div class="row">
                @include('layouts.agency_sidebar')
            </div>
        </div>
        <div class="col-sm-9" id="organization_content">
            <div class="demo-container">
                @foreach ($organizations as $organization)
                <div class="col-md-4" style="padding: 0;">
                    <div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
                      <div class="mdl-card__title">
                        @if($organization->logo!='')
                            <img src="{{$organization->logo}}" class="img-responsive center" style="height: 50px;">
                        @endif
                      </div>
                      <div class="mdl-card__actions mdl-card--border">
                        <div class="organization_div">
                        <a href="/organization_{{$organization->organizations_id}}" class="organization_title">{{str_limit($organization->name, 40)}}</a>
                        </div>
                        <a target="_blank" class="link-website" @if($organization->website!='') href="http://{{$organization->website}}" @endif>
                          Website</a>
                        <div style="padding-top: 5px;">
                          <a target="_blank" class="link_category"  @if($organization->tags!='') href="{{$organization->tags}}" @endif>
                            {{$organization->tags}}</a>
                        </div>
                      </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>

</div>
@endsection
