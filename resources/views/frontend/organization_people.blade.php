@extends('layouts.app')
@section('title', 'Agencies and Departments')
@section('content')

<div class="demo-container mdl-grid inner_organization people_content_inner">
    <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
        <div class="page-title row ">
            <div class="col-sm-2 image_main"> 
                <img src="{{asset('images/image.jpg')}}" class="img-responsive center" >
            </div>
            <div class="col-sm-10 col-xs-12">
                <div class="pull-right">
                    <p class="text-tages"> Tags: <span class="badge bg-green">Republican</span></p>
                </div>
                <div class="pull-right" style="padding-left: 20px;padding-right: 10px;">
                    <p class="text-types"> Type: 
                        <span class="badge bg-blue">Politician </span>
                    </p>
                </div>
                <div class="pull-left org_title">Name</div><br/>
                <div class="pull-left people_title_org">Title, Organization, Division</div>
                <div class="social_icon">
                    <ul>
                        <li><a href="#" title="Website"><i class="fas fa-globe"></i></a></li>
                        <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" title="RSS"><i class="fas fa-rss"></i></a></li>
                        <li><a href="#" title="Phone"><i class="fas fa-phone"></i></a></li>
                        <li><a href="#" title="Email"><i class="fas fa-envelope"></i></a></li>
                        <li><a href="#" title="Address"><i class="fas fa-map-marker-alt"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="menu-bar row">
            <ul class="nav nav-tabs desktop_tab" role="tablist">
                <li class="active"><a href="#people_contact" class="menu-title">CONTACT</a></li>
                <li><a href="#people_campaigns" id="projects_tab">CAMPAIGNS</a></li>
                <li><a href="#people_endorsement" id="services_tab">ENDORSEMENTS</a></li>
                <li><a href="#people_disclouser" id="money_tab">DISCLOSURES</a></li>
            </ul>

            <button type="button" class="btn btn-raised btn-block btn-primary org_filter">Organization Filter </button>

            <div class="tab_filter_btn">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#people_contact" class="menu-title">CONTACT</a></li>
                    <li><a href="#people_campaigns" id="projects_tab">CAMPAIGNS</a></li>
                    <li><a href="#people_endorsement" id="services_tab">ENDORSEMENTS</a></li>
                    <li><a href="#people_disclouser" id="money_tab">DISCLOSURES</a></li>
                </ul>
            </div>
             <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="people_contact">
                    <div class="row">
                        <div class="col-sm-4 address">
                            <div class="box">
                                <i class="fas fa-map-marker-alt"></i>
                                <h5>Address</h5>
                                <p>9411 Peachtree Street <br/>Minot, ND 58701</p>
                            </div>
                        </div>
                        <div class="col-sm-4 address">
                            <div class="box">
                                <i class="fas fa-phone"></i>
                                <h5>Phone</h5>
                                <p>Agency Phone: 123-456-1234 <br/>Division Phone: 123-456-1456</p>
                            </div>
                        </div>
                        <div class="col-sm-4 address">
                            <div class="box">
                                <i class="fas fa-fax"></i>
                                <h5>Fax</h5>
                                <p>Fax Number: 1-888-473-2963</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">

    var locations = <?php print_r(json_encode($organization_map)) ?>;

    var mymap_people = new GMaps({
      el: '#mymap_people',
      lat: 40.712722,
      lng: -74.006058,
      zoom:10
    });

    $.each( locations, function( index, value ){
        mymap_people.addMarker({
          lat: value.latitude,
          lng: value.longitude,
          title: value.name,
         infoWindow: {
            content: ('<a href="location_'+value.location_id+'">'+value.name+'</a></br>' +value.address_1+', ' +value.city+', '+value.state_province+', '+value.postal_code)
        }
   });
});

</script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

@include('layouts.script')
@endsection
