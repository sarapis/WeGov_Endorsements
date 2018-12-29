@extends('admin.layouts.dashboard') 

@section('template_title') Edit Home Page
@endsection 

@section('template_fastload_css') 
@endsection 

@section('content')


<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
                Home Edit
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
                {{ Form::open(array('route' => 'posts.store')) }}
                    {{ csrf_field() }}
                    <div class="box-body">
                     <!--   <div class="form-group">
                            {{Form::label('title', 'Title')}} {{Form::text('title',null,array('class' => 'form-control', 'placeholder'=>'Title'))}}
                        </div>-->

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input class="form-control" placeholder="Title" name="title" type="text" id="title" value="{{$post->title}}">
                        </div>

                        <div class="form-group">
                            <label for="body">Home Content Top</label>
                            <textarea class="form-control" placeholder="Content" id="summernote" name="body" cols="50" rows="10" style="display: none;">{!! $post->body !!}</textarea>
                           <!-- {{Form::label('body', 'Content')}}{{Form::textarea('body',null,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'summernote'))}}--> 
                        </div>
                        <div class="form-group">
                            <label for="body">Hoem Content Bottom</label>
                            <textarea class="form-control" placeholder="Content" id="summernote_bottom" name="bottom" cols="50" rows="10" style="display: none;">{!! $post->bottom !!}</textarea>
                           <!-- {{Form::label('body', 'Content')}}{{Form::textarea('body',null,array('class' => 'form-control', 'placeholder'=>'Content', 'id' => 'summernote'))}}--> 
                        </div>
                        <div class="form-group">
                            {{Form::submit('Publish Post',array('class' => 'btn btn-primary btn-sm'))}} </div>
                        {{Form::close()}}
                        <script>
                            $('#summernote').summernote({
                                // toolbar: [
                                //     // [groupName, [list of button]]
                                //     ['style', ['bold', 'italic', 'underline', 'clear']],
                                //     ['font', ['strikethrough', 'superscript', 'subscript']],
                                //     ['fontsize', ['fontsize']],
                                //     ['color', ['color']],
                                //     ['para', ['ul', 'ol', 'paragraph']],
                                //     ['height', ['height']]
                                //   ]

                            });
                        </script>
                        <script>
                            $('#summernote_bottom').summernote({
                            });
                        </script>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </section>
</div>

@endsection 

@section('template_scripts') 


@endsection