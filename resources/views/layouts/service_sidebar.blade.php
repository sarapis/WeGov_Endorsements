<aside class="">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form -->
      <div class="sidebar-form">
        <div class="has-feedback">
          <span class="glyphicon glyphicon-search form-control-input"></span>
          <div class="form-group is-empty">
            <input type="text" class="form-control form-input" placeholder="Search..." id="search_service">
          </div>        
        </div>
      </div>

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
      
          <a href="#service_type_collapse" class="item-list" data-toggle="collapse" aria-expanded="false">Service Type</a>
          <ul class="treeview-menu" id="service_type_collapse">
            <li style="padding-left: 10px;">
              @foreach($taxonomies as $taxonomy)
              @if($taxonomy->name!='')
              <div class="checkbox">             
                <label>
                  <input type="checkbox" class="taxonomy-checkbox" value="{{$taxonomy->taxonomy_id}}">  <span class="subitem-list text-uppercase">{{$taxonomy->name}}</span>
                </label>
              </div>
              @endif
              @endforeach
            </li>
          </ul>
        </li>

        <li class="treeview">

          <a href="#provide_collapse" class="item-list" data-toggle="collapse" aria-expanded="false">Provide By</a>

          <ul class="treeview-menu" id="provide_collapse">
            <li style="padding-left: 10px;">
              
                @foreach($services_organizations as $organization)
                <div class="checkbox">
                  <label>

                    <input type="checkbox" name="services_organizations[]" value="{{$organization->organization_recordid}}" class="services-checkbox">  <span class="subitem-list text-uppercase">{{$organization->organization_name}}</span>
                  </label>
                </div>
                @endforeach
              
            </li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

      $('.btn-filter').click(function(){
          $('.side-filter').toggle()
      });

      $('#search_service').change(function(){
        search_service();

        document.getElementById("loader").style.display = "block";
      });
      $('.glyphicon-search').click(function(){
        search_service();
        document.getElementById("loader").style.display = "block";
      });

      function search_service(){
        val = $('#search_service').val();
        console.log(val);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          })

        $.ajax({
          type: 'POST',
          url: '/services_search',
          data: {
            search_service: val
          },
          success: function(data){
              $('#loader').hide();
              $('#service_content').html(data);
               window.history.replaceState({url: "" + window.location.href + ""}, '','/services');
          }
        });
      }
      function send_datas(){
          var organization_value = [];
          var cboxes = $('.services-checkbox:checked');
          for(i = 0; i < cboxes.length; i ++)
            organization_value[i] = cboxes[i].value;

          var taxonomy_value = [];
          var cboxes = $('.taxonomy-checkbox:checked');
          for(i = 0; i < cboxes.length; i ++)
            taxonomy_value[i] = cboxes[i].value;

          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          })

          $.ajax({
            type: 'POST',
            url: '/services_filter',
            data: {
              organization_value: organization_value,
              taxonomy_value: taxonomy_value
            },
            success: function(data){
                $('#loader').hide();
                $('#service_content').html(data);
                 window.history.replaceState({url: "" + window.location.href + ""}, '','/services');
            }
          });
      } 
    

      $('.checkbox-material').on('click', function(e){
        setTimeout(function(){
          send_datas();
          document.getElementById("loader").style.display = "block";
        },100);
      });

      $(document).on('click', ".taxonomyid", function () {

          var organization_value = [];
          var taxonomy_value = [];
          taxonomy_value[0] = $(this).attr('id');

          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          })

          $.ajax({
            type: 'POST',
            url: '/services_filter',
            data: {
              organization_value: organization_value,
              taxonomy_value: taxonomy_value
            },
            success: function(data){
                $('#loader').hide();
                $('#service_content').html(data);
                window.history.replaceState({url: "" + window.location.href + ""}, '','/services');
            }
          });
      });  

      $(document).on('click', ".organizationid", function () {

          var organization_value = [];
          organization_value[0] = $(this).attr('id');
          var taxonomy_value = [];
          
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          })

          $.ajax({
            type: 'POST',
            url: '/services_filter',
            data: {
              organization_value: organization_value,
              taxonomy_value: taxonomy_value
            },
            success: function(data){
                $('#loader').hide();
                $('#service_content').html(data);
                window.history.replaceState({url: "" + window.location.href + ""}, '','/services');
            }
          });
      });


      $(document).on('click', "#search_location", function () {
        var val = $('#search_address').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          })

        $.ajax({
          type: 'POST',
          url: '/search_address',
          data: {
            search_address: val
          },
          success: function(data){
              $('#loader').hide();
              $('#search_address').html(' '); 
              $('#service_content').html(data);
               window.history.replaceState({url: "" + window.location.href + ""}, '','/services');
          }
        });
      });

      $(document).on('click', "#search_near", function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          })

        $.ajax({
          type: 'POST',
          url: '/search_near',
          success: function(data){
              $('#loader').hide();
              $('#service_content').html(data);
               window.history.replaceState({url: "" + window.location.href + ""}, '','/services');
          }
        });
      });

      $(function () {
        var getData = function (request, response) {
            $.getJSON(
                "https://geosearch.planninglabs.nyc/v1/autocomplete?text=" + request.term,
                function (data) {
                    response(data.features);
                    
                    var label = new Object();
                    for(i = 0; i < data.features.length; i++)
                        label[i] = data.features[i].properties.label;
                    response(label);
                });
        };
     
        var selectItem = function (event, ui) {
            $("#search_address").val(ui.item.value);
            return false;
        }
     
        $("#search_address").autocomplete({
            source: getData,
            select: selectItem,
            minLength: 2,
            change: function() {
                console.log(selectItem);

            }
        });
     
    });

    });
</script>
