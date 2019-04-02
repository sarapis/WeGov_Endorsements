@extends('layouts.app')
@section('title', 'About')

@section('content')
<style>
    .demo-container{
        min-height: 550px;
    }
</style>

<div class="demo-container mdl-grid inner_organization">
    <div class="demo-content election_menu mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col " style="padding: 0px;">
        <div class="box padding_0" style="box-shadow:none; border: none;">
            <div class="box-body">
                {!! $about->body !!}
            </div>
        </div>
        
         <!--@include('partials.footer')-->
    </div>

</div>


@endsection
