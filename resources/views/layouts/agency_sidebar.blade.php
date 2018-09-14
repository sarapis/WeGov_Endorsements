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
            <span class="item-list">Type</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li style="padding-left: 10px;">
              @foreach($types as $type)
              @if($type->type!='')
              <div class="checkbox">             
                <label>
                  <input type="checkbox" class="organization-type" value="{{$type->type}}">  <span class="subitem-list text-uppercase">{{$type->type}}</span>
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
            <span class="item-list">Tags</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li style="padding-left: 10px;">
              
                @foreach($tags as $tag)
                <div class="checkbox">
                  <label>
                    <input type="checkbox" class="organization-tag" value="{{$tag->tag_id}}">  <span class="subitem-list text-uppercase">{{$tag->tag_name}}</span>
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
          var organization_type = [];
          var cboxes = $('.organization-type:checked');
          for(i = 0; i < cboxes.length; i ++)
            organization_type[i] = cboxes[i].value;
          console.log(organization_type);

          var organization_tag = [];
          var cboxes = $('.organization-tag:checked');
          for(i = 0; i < cboxes.length; i ++)
            organization_tag[i] = cboxes[i].value;

          console.log(organization_tag); 

          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          })

          $.ajax({
            type: 'POST',
            url: '/organizations_filter',
            data: {
              organization_type: organization_type,
              organization_tag: organization_tag
            },
            success: function(data){
                $('#organization_content').html(data);
            }
          });
      }      
      $('.organization-type').on('click', function(e) {
          send_datas();
      });
      $('.organization-tag').on('click', function(e){
          send_datas();
      });

    });
</script>