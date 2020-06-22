@extends('layouts.app')
@section('title', 'Agencies and Departments')
@section('content')

<div class="demo-container mdl-grid inner_organization people_content_inner">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <!-- start elections contentbar -->
        <div class="row">
            <div class="col-sm-12 election_menu">
                @foreach($elections as $election)
                <div class="col-sm-4">
                    <div class="box padding_0">
                        <div class="box-header">
                            <h3 class="box-title"><a href="/elections/{{$election->recordid}}">{{$election->name}}</a></h3>
                        </div>
                        <div class="box-body">
                            <p><i class="fas fa-calendar-alt"></i> Election Day:  {!! date("m/d/Y", strtotime($election->election_day)) !!}</p>
                            <div>
                                <p>{{$election->description}}</p>
                            </div>
                            <h5><span>{{$election->of_offices}}</span>Offices</h5>
                            <h5><span>{{$election->of_candidates}}</span>Candidates</h5>
                            <h5><span>{{$election->of_endorsements}}</span>Endorsements</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- end elections contentbar -->
    </div>

</div>

@endsection
