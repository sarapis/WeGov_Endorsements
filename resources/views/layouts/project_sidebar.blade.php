<aside class="">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form -->
      <div class="sidebar-form">
        <div class="has-feedback">
          <span class="glyphicon glyphicon-search form-control-input"></span>
          <div class="form-group is-empty">
            <input type="text" class="form-control form-input" placeholder="Search..." id="search_project">
          </div>        
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

       
        <li class="treeview">

          <a href="#agency_collapse" class="item-list" data-toggle="collapse" aria-expanded="false">Managing Agency</a>
          <ul class="treeview-menu" id="agency_collapse">
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

          // console.log(organization_value);
          // console.log(project_type);
          if(project_type.length == 0 && organization_value.length == 0){
            window.location.href = '/projects';
          }
          else {
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
      }      
      $('.checkbox-material').on('click', function(e){
        setTimeout(function(){
          send_datas();
          document.getElementById("loader").style.display = "block";
        },100);
      });

    });
</script>