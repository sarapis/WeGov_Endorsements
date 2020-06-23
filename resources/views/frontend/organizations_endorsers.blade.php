@extends('layouts.app')
@section('title', 'Agencies and Departments')

@section('content')

<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="container">
          <button type="button" class="btn btn-raised btn-block btn-primary btn-filter">Filter</button>
        </div>
        <div class="col-sm-3 side-filter">
            @include('layouts.agency_sidebar_endorsers')
        </div>
        <div class="col-sm-9 organization_right" id="organization_content">
            <div class="">
                @foreach ($organizations as $organization)
                <div class="col-sm-4 col-md-4 col-xs-6">
                    <div class="org_inner_right">
                        <div class="org_img">
                          @if($organization->logo!='')
                              <img src="{{$organization->logo}}" class="img-responsive center" >
                          @endif
                        </div>
                        <h5 class="org_title">
                            <a href="/organization_{{$organization->organizationid}}/endorsements">{{str_limit($organization->organization, 40)}}</a>
                        </h5>
                        <!-- <a target="_blank" class="org_website" @if($organization->website!='') href="http://{{$organization->website}}" @endif > Website <i class="fa fa-external-link" aria-hidden="true"></i></a> -->
                        <?php 
                            $tag_names = explode(',', $organization->tags);
                            ?>
                          @foreach($tag_names as $tag_name)
                            @if($tag_name!='')
                              <span class="org_tags">{{$tag_name}}</span>
                            @endif
                          @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection


