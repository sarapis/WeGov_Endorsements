@extends('layouts.app')
@section('title', 'Agencies and Departments')

@section('content')


<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col" style="padding-top: 0;">
        <div class="container">
          <button type="button" class="btn btn-raised btn-block btn-primary btn-filter">Filter</button>
        </div>
        <div class="col-sm-3 side-filter" style="border-right: 1px solid #3f3f3f; height: 100%;">
            <div class="row">
                @include('layouts.agency_sidebar')
            </div>
        </div>
        <div class="col-sm-9" id="organization_content">
            <div class="demo-container row">
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
                          Website<i class="fa fa-fw fa-external-link"></i></a>
                        <div style="padding-top: 5px;">
                          <?php 
                            $tag_names = explode(',', $organization->tag_names);
                            ?>
                          @foreach($tag_names as $tag_name)
                            @if($tag_name!='')
                              <span class="badge bg-green">
                                {{$tag_name}}</span>
                            @endif
                          @endforeach
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
