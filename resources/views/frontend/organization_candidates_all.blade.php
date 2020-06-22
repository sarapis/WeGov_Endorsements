@extends('layouts.app')
@section('title', 'Agencies and Departments')

@section('content')

<div class="demo-container mdl-grid">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="container">
          <button type="button" class="btn btn-raised btn-block btn-primary btn-filter">Filter</button>
        </div>
        <div class="col-sm-3 side-filter">
            @include('layouts.agency_sidebar')
        </div>
        <div class="col-sm-9 candidates_right" id="candidates_year_search">
            <div class="year-search-form">
                <div class="has-feedback"  style="width: 100px;">
                    <span class="glyphicon glyphicon-search form-control-input" id="glyphicon-search-year"></span>
                    <div class="form-group is-empty">
                        <input type="text" class="form-control form-input" placeholder="Year..." id="search_year">
                    </div> 
                </div>       
            </div>
        </div>
        <div class="col-sm-9 organization_right" id="candidates_content">
            <div class="">
                @foreach ($candidates as $candidate)
                <div class="col-sm-4 col-md-4 col-xs-6">
                    <div class="org_inner_right">
                        <h5 class="org_title">
                            <a href="/candidates/{{$candidate->recordid}}">{{str_limit($candidate->name, 40)}}</a>
                        </h5>
                        <div class="box-body">
                            <p style="font-size: 12px;"><i class="fas fa-calendar-alt"></i> Election Year:  {{$candidate->election_year}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {

        $('#glyphicon-search-year').click(function(){
            search_year();
        });

        $('#search_year').change(function(){
            search_year();
        });

        function search_year(){
            val = $('#search_year').val();
            console.log(val);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            $.ajax({
                type: 'POST',
                url: '/candidates_search_year',
                data: {
                    search_year: val
                },
                success: function(data){
                    $('#candidates_content').html(data);
                }
            });
        }
    });

</script>

@endsection


