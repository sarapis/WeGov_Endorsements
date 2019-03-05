@extends('admin.layouts.dashboardhome') 

@section('template_title') Appearance
@endsection 

@section('template_fastload_css') 
@endsection 

@section('content')

<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
<link rel="stylesheet" type="text/css" href="../css/AdminLTE.min.css">

<div class="content-wrapper">
    <section class="content-header">
        <h1>
				Appearance
				<small> {{ Lang::get('pages.dashboard-access-level',['access' => $access] ) }} </small>
			</h1>

    </section>
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                @if($success == 'true')
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 2em;">×</button>
                        {{$message}}                
                    </div>
                @endif
                @if($success == 'false')
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 2em;">×</button>
                        {{$message}}                
                    </div>
                @endif
                {{ Form::open(array('route' => 'appearance.store')) }}
                    {{ csrf_field() }}
                    <div class="box-body">
                     <!--   <div class="form-group">
                            {{Form::label('title', 'Title')}} {{Form::text('title',null,array('class' => 'form-control', 'placeholder'=>'Title'))}}
                        </div>-->

                        <div class="form-group">
                            <label for="title">Site Name</label>
                            <input class="form-control" placeholder="Site Name" name="site_name" type="text" id="title" value="{{$layout->find(1)->link}}">
                        </div>

                        <div class="form-group">
                            <label for="title">Site Tagline</label>
                            <input class="form-control" placeholder="Site Tagline" name="site_tagline" type="text" id="title" value="{{$layout->find(2)->link}}">
                        </div>

                        <div class="form-group">
                            <label for="title">Site Logo</label>
                            <input class="form-control" placeholder="Site Tagline" name="site_tagline" type="text" id="title" value="{{$layout->find(2)->link}}">
                        </div>

                        <div class="form-group">
                            <label for="title">Footer Text</label>
                            <input class="form-control" placeholder="Site Tagline" name="site_tagline" type="text" id="title" value="{{$layout->find(4)->link}}">
                        </div>

                        <div class="form-group">
                            <label for="title">Footer Button</label>
                            <input class="form-control" placeholder="Site Tagline" name="site_tagline" type="text" id="title" value="{{$layout->find(5)->link}}">
                        </div>

                        <div class="form-group">
                            <label for="title">Footer Button Link</label>
                            <input class="form-control" placeholder="Site Tagline" name="site_tagline" type="text" id="title" value="{{$layout->find(6)->link}}">
                        </div>

                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </section>
</div>

@endsection 

@section('template_scripts') 


@endsection