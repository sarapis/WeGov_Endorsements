<aside>
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
<!--       <form action="#" method="get" class="sidebar-form">
        <div class="has-feedback">
          <span class="glyphicon glyphicon-search form-control-input"></span>
          <div class="form-group is-empty">
            <input type="text" class="form-control form-input" placeholder="Search Address">
          </div>        
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview menu-open">
          <span class="item-list">Type</span>
            <ul class="treeview-menu" style="display: block !important;">
              <li style="padding-left: 10px;">
                @if(isset($taxonomy_lists))
                @foreach($taxonomy_lists as $taxonomy_list)
                <div class="checkbox">             
                  <label>
                    <input type="checkbox" class="organization-type">  <span class="subitem-list text-uppercase">{{$taxonomy_list->name}}</span>
                  </label>
                </div>
                @endforeach
                @endif
              </li>
          </ul>
        </li>
        <li class="treeview menu-open">
          <span class="item-list">Tags</span>
          <ul class="treeview-menu" style="display: block !important;">
            <li style="padding-left: 10px;">
              @if(isset($organization_lists))
                @foreach($organization_lists as $organization_list)
                <div class="checkbox">
                  <label>
                    <input type="checkbox" class="organization-tag">  <span class="subitem-list text-uppercase">{{$organization_list->name}}</span>
                  </label>
                </div>
                @endforeach
              @endif
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
    });
</script>