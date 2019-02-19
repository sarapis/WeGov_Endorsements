@extends('layouts.app')
@section('title', 'Agencies and Departments')
@section('content')

<div class="demo-container mdl-grid inner_organization people_content_inner">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <!-- start elections contentbar -->
        <div class="row">
            <div class="col-sm-12 election_menu detail_elec">
                <div class="col-sm-12">
                    <div class="box padding_0">
                        <div class="box-header">
                            <h3 class="box-title"><a href="#">{{$election->name}}</a></h3>
                            <p><i class="fas fa-calendar-alt"></i> Election Day:  {!! date("m/d/Y", strtotime($election->election_day)) !!}</p>
                        </div>
                        <div class="box-body">
                            <p>{{$election->description}}</p>
                            <h5><span>{{$election->of_offices}}</span>Offices</h5>
                            <h5><span>{{$election->of_candidates}}</span>Candidates</h5>
                            <h5><span>{{$election->of_endorsements}}</span>Endorsements</h5>
                        </div>
                    </div>
                </div>
            
                <div class="col-sm-12 election_menu">
                    
                        <div class="table-responsive">
                            <table id="example3" class="table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="text-align: left; width: 30%;">Office</th>
                                        <th style="text-align: right;" class="text-left"># of Candidates</th>
                                        <th style="text-align: right;"># of Endorsements</th>
                                        <th style="text-align: center; width: 30%;">Winner</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($offices as $office)
                                    <tr>
                                        <td class="people-link">@if(isset($office->office)) <a href="/organization_{{$office->organization()->first()->organizationid}}">{{$office->organization()->first()->organization}}</a> @endif</td>
                                        <td class="text-right">{{$office->sum_candidates}}</td>
                                        <td class="text-right">{{$office->sum_endorsements}}</td>
                                        <td class="text-center">@if(isset($office->politician)) {{$office->politicians()->first()->name}} @endif</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    
                </div>
            </div>
        <!-- end elections contentbar -->
        </div>
    </div>
</div>

<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#example3').DataTable({
      'paging'      : true,
      'pageLength'  : 20,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    });
} );
</script>
@endsection
