@extends('admin.layouts.dashboard') 

@section('template_title') Appearance
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
<style type="text/css">
   .checkbox input[type=checkbox]{
        margin-left: -20px !important;
        margin: 4px, 0, 0;
    }
    input[type=checkbox]{
        margin: 4px 0 0 !important;
    }
</style>
<div class="content-wrapper">
    <section class="content">
        <div class="row">

            <div class="col-md-12">

                @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 2em;">×</button>
                        {{ Session::get('message') }}               
                    </div>
                @endif
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                 <h3 class="box-title">Apperance</h3>
            </div>

            <form action="/appearance" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Site Name</label>
                  <input type="text" class="form-control" placeholder="Site Name" name="site_name" value="{{$layout->find(1)->link}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Site Tagline</label>
                  <input type="text" class="form-control" placeholder="Site Tagline" name="site_tagline" value="{{$layout->find(2)->link}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Site Logo</label>
                  <input type="file" id="site_logo" onchange="readURL(this);" name="site_logo">
                  <img src="/upload/images/{{$layout->find(3)->link}}" id="blah">
                </div>
                <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" class="form-checkbox" value="checked" name="logo_active"  @if($layout->find(3)->action) checked @endif>
                      Show Site Logo
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" class="form-checkbox" value="checked" name="name_active"  @if($layout->find(1)->action) checked @endif>
                      Show Site Name
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" class="form-checkbox" name="tagline_active" @if($layout->find(2)->action) checked @endif value="checked" >
                      Show Site Tagline
                    </label>
                  </div>
                </div>
              
                <div class="form-group">
                    <label for="title">Footer Text</label>
                    <input class="form-control" placeholder="Footer Text" name="footer_text" type="text" id="title" value="{{$layout->find(4)->link}}">
                </div>

                <div class="form-group">
                    <label for="title">Footer Button</label>
                    <input class="form-control" placeholder="Footer Button" name="footer_button" type="text" id="title" value="{{$layout->find(5)->link}}">
                </div>

                <div class="form-group">
                    <label for="title">Footer Button Link</label>
                    <input class="form-control" placeholder="Footer Link" name="footer_link" type="text" id="title" value="{{$layout->find(6)->link}}">
                </div>
            </div>
    
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </section>
</div>

@endsection 

@section('template_scripts') 
<script>

function readURL(input) {
    if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection