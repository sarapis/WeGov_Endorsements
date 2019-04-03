<style>
    .demo-container{
        min-height: 800px;
    }
</style>
<div id="service_content">
    @foreach($organization_services as $organization_service)
        @if($organization_service->name!=null)
        <div class="box box-service">
            <!-- <p class="text-aqua" id="{{$organization_service->name}}">{{$organization_service->name}}</p> -->

            <a href="{{URL::to('organization_'.$organization_service->organization_x_id.'/services/'.$organization_service->name)}}" class="text-aqua">{{$organization_service->name}}</a>

            <p>Category: <span class="taxonomyid" id="{{$organization_service->taxonomy}}">{{$organization_service->taxonomy()->first()->name}}</span></p>

            <p>Proviced by: <span class="organizationid" id="{{$organization_service->organization}}">{{$organization_service->organization()->first()->organization_name}}</span></p>
            <p>Phone: {!! $organization_service->phone_numbers !!}</p>
        </div>
        @endif
    @endforeach
</div>

<!-- <script src="{{ asset('js/frontend/organization_service_ajax.js') }}"></script> -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>