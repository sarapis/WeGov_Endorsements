<aside>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form -->
      <div class="sidebar-form">
        <div class="has-feedback">
          <span class="glyphicon glyphicon-search form-control-input"></span>
          <div class="form-group is-empty">
            <input type="text" class="form-control form-input" placeholder="Search..." id="search_agency">
          </div>        
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
<!--             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> -->
          <a href="#type_collapse" class="item-list" data-toggle="collapse" aria-expanded="false">Type</a>
          <ul class="treeview-menu" id="type_collapse">
            <li style="padding-left: 10px;">
              @foreach($types as $type)
              
              @if($type->type!='')
                @if (isset($post_type) && $post_type == "type")
                  <div class="checkbox">             
                    <label>
                      <input type="checkbox" class="organization-type" value="{{$type->type}}" @if($type->type==$post_value) checked @endif>  <span class="subitem-list text-uppercase">{{$type->type}}</span>
                    </label>
                  </div>
                @else
                  <div class="checkbox">             
                    <label>
                      <input type="checkbox" class="organization-type" value="{{$type->type}}" @if($type->type=='City Agency' && (!isset($post_type) || $post_type!="tag")) checked @endif>  <span class="subitem-list text-uppercase">{{$type->type}}</span>
                    </label>
                  </div>
                @endif
              @endif
              @endforeach
            </li>
          </ul>
        </li>

        <li class="treeview">
  <!--           <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> -->
          <a href="#tag_collapse" class="item-list" data-toggle="collapse" aria-expanded="false">Tags</a>
          <ul class="treeview-menu" id="tag_collapse">
            <li style="padding-left: 10px;">
              
                @foreach($tags as $tag)
                  @if (isset($post_type) && $post_type == "tag")
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" class="organization-tag" value="{{$tag->tag_name}}" @if($tag->tag_name==$post_value) checked @endif>  <span class="subitem-list text-uppercase">{{$tag->tag_name}}</span>
                      </label>
                    </div>
                  @else
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" class="organization-tag" value="{{$tag->tag_name}}">  <span class="subitem-list text-uppercase">{{$tag->tag_name}}</span>
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

      $('#search_agency').change(function(){
        search_agency();

        document.getElementById("loader").style.display = "block";
      });
      $('.glyphicon-search').click(function(){
        search_agency();
        document.getElementById("loader").style.display = "block";
      });
      function search_agency(){
        val = $('#search_agency').val();
        console.log(val);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          })

        $.ajax({
          type: 'POST',
          url: '/organizations_search',
          data: {
            search_agency: val
          },
          success: function(data){
              $('#loader').hide();
              $('#organization_content').html(data);
          }
        });
      }

      function send_datas(){
          var organization_type = [];
          var cboxes = $('.organization-type:checked');
          for(i = 0; i < cboxes.length; i ++)
            organization_type[i] = cboxes[i].value;

          var organization_tag = [];
          var cboxes = $('.organization-tag:checked');
          for(i = 0; i < cboxes.length; i ++)
            organization_tag[i] = cboxes[i].value;

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
                $('#loader').hide();
                $('#organization_content').html(data);
            }
          });
      }      
      // $('.organization-type').on('click', function(e) {
      //     send_datas();
      //     document.getElementById("loader").style.display = "block"; 
      // });
      // $('.organization-tag').on('click', function(e){
      //     send_datas();
      //     document.getElementById("loader").style.display = "block"; 
      // });
      $('.checkbox-material').on('click', function(e){
        setTimeout(function(){
          send_datas();
          document.getElementById("loader").style.display = "block";
        },100);
      });

    });
</script>