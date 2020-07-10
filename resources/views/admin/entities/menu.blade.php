@extends('admin.layouts.dashboard') 

@section('template_title') Main Menu
@endsection 

@section('template_fastload_css') 
@endsection 

@section('content')

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
                 <h3 class="box-title">Main Menu</h3>
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