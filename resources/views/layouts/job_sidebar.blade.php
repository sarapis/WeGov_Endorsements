<aside class="">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form -->
      <div class="sidebar-form">
        <div class="has-feedback">
          <span class="glyphicon glyphicon-search form-control-input"></span>
          <div class="form-group is-empty">
            <input type="text" class="form-control form-input" placeholder="Search..." id="search_job">
          </div>        
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

       
        <li class="treeview">

          <a href="#agency_collapse" class="item-list" data-toggle="collapse" aria-expanded="false">City Agencies</a>
          <ul class="treeview-menu" id="agency_collapse">
            <li style="padding-left: 10px;">
              
                @foreach($organizations as $organization)
                @if($organization->magencyacro!='')
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="projects_organizations[]" value="{{$organization->magency}}" class="organization-checkbox">  <span class="subitem-list text-uppercase">{{$organization->magencyacro}}</span>
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

      $('#search_job').change(function(){
        search_job();

        document.getElementById("loader").style.display = "block";
      });
      $('.glyphicon-search').click(function(){
        search_job();
        document.getElementById("loader").style.display = "block";
      });
      
      function search_job(){
        val = $('#search_job').val();
        console.log(val);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          })

        $.ajax({
          type: 'POST',
          url: '/jobs_search',
          data: {
            search_job: val
          },
          success: function(data){
              $('#loader').hide();
              $('#job_content').html(data);
              window.history.replaceState({url: "" + window.location.href + ""}, '','/jobs');
          }
        });
      }

      function send_datas(){
          var organization_value = [];
          var cboxes = $('.organization-checkbox:checked');

          for(i = 0; i < cboxes.length; i ++)
            organization_value[i] = cboxes[i].value;


          // console.log(organization_value);

          if(organization_value.length == 0){
            window.location.href = '/jobs';
          }
          else {
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            })

            $.ajax({
              type: 'POST',
              url: '/jobs_filter',
              data: {
                organization_value: organization_value
              },
              success: function(data){
                  $('#loader').hide();
                  $('#job_content').html(data);
                  window.history.replaceState({url: "" + window.location.href + ""}, '','/jobs');
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