@extends('admin.layouts.dashboardhome') 

@section('template_title') Main Menu
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
                 <h3 class="box-title">Entity Main Menu</h3>
            </div>

            <form action="/entity_main" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                  @foreach($menus as $menu)
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" class="form-checkbox" value="{{$menu->id}}" name="menu[]"  @if($menu->action) checked @endif>
                      {{$menu->menu}}
                    </label>
                  </div>
                  @endforeach
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