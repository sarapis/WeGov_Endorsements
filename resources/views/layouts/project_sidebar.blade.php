<aside class="">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar"  style="padding-top: 20px;">
      <!-- search form -->
      <div class="sidebar-form">
        <div class="has-feedback">
          <span class="glyphicon glyphicon-search form-control-input"></span>
          <div class="form-group is-empty">
            <input type="text" class="form-control form-input" placeholder="Search..." id="search_project">
          </div>        
        </div>
      </div>

      <hr>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
            <span class="item-list">Project Type</span>
          <ul class="treeview-menu" style="display: block !important;">
            <li style="padding-left: 10px;">
              @foreach($project_types as $project_type)
              @if($project_type->project_type!='')
              <div class="checkbox">             
                <label>
                  <input type="checkbox" class="project-type" value="{{$project_type->project_type}}">  <span class="subitem-list text-uppercase">{{$project_type->project_type}}</span>
                </label>
              </div>
              @endif
              @endforeach
            </li>
          </ul>
        </li>
        <hr>
        <li class="treeview">
            <span class="item-list">Managing Agency</span>

          <ul class="treeview-menu" style="display: block !important;">
            <li style="padding-left: 10px;">
              
                @foreach($organizations as $organization)
                @if($organization->magencyacro!='')
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="projects_organizations[]" value="{{$organization->agency_recordid}}" class="organization-checkbox">  <span class="subitem-list text-uppercase">{{$organization->magencyacro}}</span>
                  </label>
                </div>
                @endif
                @endforeach
              
            </li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {

      $('.btn-filter').click(function(){
          $('.side-filter').toggle()
      });

      $('#search_project').change(function(){
        search_project();

        document.getElementById("loader").style.display = "block";
      });
      $('.glyphicon-search').click(function(){
        search_project();
        document.getElementById("loader").style.display = "block";
      });
      function search_project(){
        val = $('#search_project').val();
        console.log(val);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          })

        $.ajax({
          type: 'POST',
          url: '/projects_search',
          data: {
            search_project: val
          },
          success: function(data){
              $('#loader').hide();
              $('#project_content').html(data);
              window.history.replaceState({url: "" + window.location.href + ""}, '','/projects');
          }
        });
      }

      function send_datas(){
          var organization_value = [];
          var cboxes = $('.organization-checkbox:checked');
          for(i = 0; i < cboxes.length; i ++)
            organization_value[i] = cboxes[i].value;

          var project_type = [];
          var cboxes = $('.project-type:checked');
          for(i = 0; i < cboxes.length; i ++)
            project_type[i] = cboxes[i].value;

          console.log(organization_value);
          console.log(project_type);

          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          })

          $.ajax({
            type: 'POST',
            url: '/projects_filter',
            data: {
              organization_value: organization_value,
              project_type: project_type
            },
            success: function(data){
                $('#loader').hide();
                $('#project_content').html(data);
                window.history.replaceState({url: "" + window.location.href + ""}, '','/projects');
            }
          });
      }      
      $('.organization-checkbox').on('click', function(e) {
          send_datas();
          document.getElementById("loader").style.display = "block";
      });
      $('.project-type').on('click', function(e){
          send_datas();
          document.getElementById("loader").style.display = "block";     
      });

    });
</script>