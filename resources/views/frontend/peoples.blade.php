@extends('layouts.app')
@section('title', 'People')
@section('content')

<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="container">
          <button type="button" class="btn btn-raised btn-block btn-primary btn-filter">Filter</button>
        </div>
        <div class="col-sm-12 organization_right people" id="organization_content">
            <div class="">
                @foreach ($peoples as $people)
                <div class="col-sm-3 col-md-3 col-xs-6">
                    <div class="org_inner_right inner_people">
                        <div class="org_img">
                            <img src="{{asset('images/image.jpg')}}" class="img-responsive center" >
                        </div>
                        <a href="/people/{{$people->id}}">{{$people->first_name}} {{$people->last_name}}</a>
                        <p>{{$people->office_title}}, {{$people->organization_name}} {{$people->division_name}}
                        @if($people->parent_division!=''), {{$people->parent_division}}@endif @if($people->grand_parent_division!=''), {{$people->grand_parent_division}}@endif
                        @if($people->great_grand_parent_division!=''), {{$people->great_grand_parent_division}}@endif</p>
                    </div>
                </div>
                @endforeach
            </div>
            <dir class="text-right col-sm-12" style="float: right;width: 100%;">
                {{$peoples->links()}}
            </dir>
        </div>
    </div>
</div>

@endsection
