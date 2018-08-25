<div id="people_content">
<table id="example1" class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr class="info">
            <th>Name</th>
            <th>Title</th>
            <th>Division</th>
        </tr>
    </thead>
    <tbody>
        @foreach($organization_peoples as $organization_people)
        <tr>
            <td class="people-link" id="{{$organization_people->contact_id}}">{{$organization_people->name}}</td>
            <td>{{$organization_people->office_title}}</td>
            <td>{{$organization_people->division_name}}
            @if($organization_people->parent_division!=''), {{$organization_people->parent_division}}@endif @if($organization_people->grand_parent_division!=''), {{$organization_people->grand_parent_division}}@endif
            @if($organization_people->great_grand_parent_division!=''), {{$organization_people->great_grand_parent_division}}@endif</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<script src="{{ asset('js/frontend/organization_people_ajax.js') }}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#example1').DataTable();
} );
</script>