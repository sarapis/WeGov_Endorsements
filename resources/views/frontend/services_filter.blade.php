@foreach($organization_services as $organization_service)
    <div class="box box-service">
        <p>Category: {{$organization_service->taxonomy()->first()->name}}</p>
        <p class="text-aqua" id="{{$organization_service->service_id}}">{{$organization_service->name}}</p>
        <p>Proviced by: {{$organization_service->organization()->first()->organization_name}}</p>
        <p>Phone: {!! $organization_service->services_phone_number !!}</p>
    </div>
@endforeach
<script src="{{ asset('js/frontend/organization_service_ajax.js') }}"></script>