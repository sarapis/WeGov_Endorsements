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

      <hr>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
       
            <span class="item-list">Service Type</span>

          <ul class="treeview-menu"  style="display: block !important;">
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
        <hr>
        <li class="treeview">
   
            <span class="item-list">Provide By</span>

          <ul class="treeview-menu" style="display: block !important;">
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
                $('#service_content').html(data);
                 window.history.replaceState({url: "" + window.location.href + ""}, '','/services');
            }
          });
      } 
    
      $('.services-checkbox').on('click', function(e) {
          send_datas();
      });

      $('.taxonomy-checkbox').on('click', function(e){
          send_datas();
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
                $('#service_content').html(data);
                window.history.replaceState({url: "" + window.location.href + ""}, '','/services');
            }
          });
      });

      

    });
</script>
