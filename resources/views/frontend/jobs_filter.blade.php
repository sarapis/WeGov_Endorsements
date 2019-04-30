<div class="col-sm-12" style="padding-left:0px;">
  <div class="box padding_0 table_data">
    <div class="box padding_0 table_data">
        <div class="padding_0 table-responsive">
            <table id="example3" class="table table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                      <th style="text-align:center; width: 8%; vertical-align: middle;" class="sorting_asc">Job ID#</th>
                      <th style="text-align:center; vertical-align: middle;" class="sorting_asc">Agency</th>
                      <th style="text-align:center; vertical-align: middle;" class="sorting_asc">Business Title</th>
                      <th style="text-align:center; vertical-align: middle;" class="sorting_asc">Job Category</th>
                      <th style="text-align:center; vertical-align: middle;" class="sorting_asc">Work Location</th>
                      <th style="text-align:center; vertical-align: middle;" class="sorting_asc">Posting Date</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($jobs as $job)
                  <tr>
                      <td><a href="/organization_{{$job->organization_code}}/jobs/{{$job->job_id}}">{{$job->job_id}}</a></td>
                      <td><a href="/organization_{{$job->organization_code}}/jobs">{{$job->agency}}</a></td>
                      <td>{{$job->business_title}}</td>
                      <td>{{$job->job_category}}</td>
                      <td>{{$job->work_location}}</td>
                      <td>{{$job->process_date}}</td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#example3').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'pageLength'  : 30,
      'searching'   : false,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : false,
      'responsive': true
  });
});
</script>