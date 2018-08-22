<p>Projects implemented by the <b>{{$organization->name}}</b></p>
<div class="box">
    <!-- /.box-header -->
    @if($organization->projects!='')
    <div class="box-body no-padding">
        <table id="example2" class="table table-hover">
            <tbody>
                <tr>
                    <th>Project Description</th>
                    <th class="text-center">Commitments (#)</th>
                    <th class="text-right" style="padding-right: 50px;">Cost ($)</th>
                    <th>Budgetline (click)</th>
                    <th>ID (click)</th>
                </tr>
                @foreach($organization_projects as $organization_project)
                    @if($organization_project->project_description!=null)
                        <tr>
                          <td>{{$organization_project->project_description}}</td>
                          <td class="text-center">
                            {{sizeof(explode(",", $organization_project->project_commitments))}}
                          </td>
                          <td class="text-right" style="padding-right: 50px;">${{number_format($organization_project->project_totalcost)}}</td>
                          <td></td>
                          <td><a href="projects_{{$organization_project->project_recordid}}">{{$organization_project->project_projectid}}</a></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    @else
     <div class="alert alert-danger"><strong>No Projects!</strong>
     </div>
    @endif
</div>