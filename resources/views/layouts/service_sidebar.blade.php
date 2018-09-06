<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="has-feedback">
          <span class="glyphicon glyphicon-search form-control-input"></span>
          <div class="form-group is-empty">
            <input type="text" class="form-control form-input" placeholder="Search...">
          </div>        
        </div>
      </form>
      <form action="#" method="get" class="sidebar-form">
        <div class="has-feedback">
          <span class="glyphicon glyphicon-search form-control-input"></span>
          <div class="form-group is-empty">
            <input type="text" class="form-control form-input" placeholder="Search Address">
          </div>        
        </div>
      </form>
      <hr>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
          <a href="#">
            <span class="item-list">Service Type</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
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
          <a href="#">
            <span class="item-list">Provide By</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li style="padding-left: 10px;">
              
                @foreach($services_organizations as $organization)
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="services_organizations[]" value="{{$organization->organization_recordid}}" class="servives-checkbox">  <span class="subitem-list text-uppercase">{{$organization->organization_x_id}}</span>
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
      function send_datas(){
          var organization_value = [];
          var cboxes = $('.servives-checkbox:checked');
          for(i = 0; i < cboxes.length; i ++)
            organization_value[i] = cboxes[i].value;
          console.log(organization_value);

          var taxonomy_value = [];
          var cboxes = $('.taxonomy-checkbox:checked');
          for(i = 0; i < cboxes.length; i ++)
            taxonomy_value[i] = cboxes[i].value;

          console.log(taxonomy_value); 

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
            }
          });
      }      
      $('.servives-checkbox').on('click', function(e) {
          send_datas();
      });
      $('.taxonomy-checkbox').on('click', function(e){
          send_datas();
      });

    });
</script>
