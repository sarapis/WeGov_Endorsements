{{--  LEFT SIDEBAR WITH NAVIGATION AND LOGO --}}
<aside class="main-sidebar">

    {{--  SIDEBAR: style can be found in sidebar.less --}}
    <section class="sidebar">

        {{--  GRAVATAR AND USE STATUS PANEL --}}
        <div class="user-panel">
            <div class="pull-left image">
              {!! HTML::show_gravatar() !!}
            </div>
            <div class="pull-left info">
                <p>
                    {!! HTML::show_username() !!}
                </p>
                {{-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> --}}
            </div>
        </div>

        {{-- SIDEBAR SEARCH FORM --}}
       

        {{-- SIDEBAR NAVIGATION: style sidebar.less --}}
        <ul class="sidebar-menu" style="height: 2100px;">

            <li class="header">
                {{ Lang::get('sidebar-nav.nav_title') }}
            </li>

            <li class="active">
                {!! HTML::icon_link( "/dashboard", 'fa '.Lang::get('sidebar-nav.link_icon_dashboard'), "<span>".Lang::get('sidebar-nav.link_title_dashboard')."</span>", array('title' => Lang::get('sidebar-nav.link_title_dashboard'))) !!}
            </li>
            <li class="treeview">
              <a href="/posts">
                <i class="fa fa-files-o"></i>
                <span>Pages</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/posts"><i class="fa fa-pencil"></i> Home</a></li>
                <li><a href="/abouts"><i class="fa fa-info-circle"></i> About</a></li>
                <li><a href="/datas"><i class="fa fa-archive"></i> Data</a></li>
                <li><a href="/law"><i class="fa fa-balance-scale"></i> Laws</a></li>
                <li><a href="/involves"><i class="fa fa-handshake-o"></i> Get Involved</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="/datasync">
                <i class="fa fa-database"></i>
                <span>Data</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/datasync"><i class="fa fa-refresh"></i> Sync</a></li>
                <li><a href="/logs" target="_blank"><i class="fa fa-history"></i> Log</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="/datasync">
                <i class="fa fa-table"></i>
                <span>Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/tb_projects"><i class="fa fa-circle-o"></i> Projects </a></li>
                <li><a href="/tb_commitments"><i class="fa fa-circle-o"></i> Commitments </a></li>
                <li><a href="/tb_expense"><i class="fa fa-circle-o"></i> Expense </a></li>
                <li><a href="/tb_organization"><i class="fa fa-circle-o"></i> Organization </a></li>
                <li><a href="/tb_organizations"><i class="fa fa-circle-o"></i> Organizations </a></li>
                <li><a href="/tb_contacts"><i class="fa fa-circle-o"></i> Contacts </a></li>
                <li><a href="/tb_services"><i class="fa fa-circle-o"></i> Services </a></li>
                <li><a href="/tb_locations"><i class="fa fa-circle-o"></i> Locations </a></li>
                <li><a href="/tb_address"><i class="fa fa-circle-o"></i> Address </a></li>
                <li><a href="/tb_phones"><i class="fa fa-circle-o"></i> Phones </a></li>
                <li><a href="/tb_schedule"><i class="fa fa-circle-o"></i> Schedule </a></li>
                <li><a href="/tb_programs"><i class="fa fa-circle-o"></i> Programs </a></li>
                <li><a href="/tb_taxonomy"><i class="fa fa-circle-o"></i> Taxonomy </a></li>
                <li><a href="/tb_details"><i class="fa fa-circle-o"></i> Details </a></li>
                <li><a href="/tb_greenbook"><i class="fa fa-circle-o"></i> Greenbook </a></li>
              </ul>
            </li>
            
            @if (Auth::user()->profile)
                <li class="treeview">
                    {!! HTML::icon_link( "/profile/".Auth::user()->name, 'fa '.Lang::get('sidebar-nav.link_icon_profile_top'), "<span>".Lang::get('sidebar-nav.link_title_profile_top')."</span><i class='fa ".Lang::get('sidebar-nav.caret_folded')." pull-right'></i>", array('title' => Lang::get('sidebar-nav.link_title_profile_top'))) !!}
                    <ul class="treeview-menu">
                        <li>
                            {!! HTML::icon_link( "/profile/".Auth::user()->name, 'fa '.Lang::get('sidebar-nav.link_icon_profile_view'), Lang::get('sidebar-nav.link_title_profile_view'), array('title' => Lang::get('sidebar-nav.link_title_profile_view'))) !!}
                        </li>
                        @if (Auth::user()->id == Auth::user()->id)
                            <li>
                                {!! HTML::icon_link( "/profile/".Auth::user()->name."/edit", 'fa '.Lang::get('sidebar-nav.link_icon_profile_edit'), Lang::get('sidebar-nav.link_title_profile_edit'), array('title' => Lang::get('sidebar-nav.link_title_profile_edit'))) !!}
                            </li>
                        @endif
                    </ul>
                </li>
            @endif




          @if (Auth::user()->hasRole('administrator'))
            <li class="treeview">
                {!! HTML::icon_link( "/users", 'fa '.Lang::get('sidebar-nav.link_icon_users'), "<span>".Lang::get('sidebar-nav.link_title_users')."</span><i class='fa ".Lang::get('sidebar-nav.caret_folded')." pull-right'></i>", array('title' => Lang::get('sidebar-nav.link_title_users'))) !!}
                <ul class="treeview-menu">
                    <li>
                        {!! HTML::icon_link( "/users", 'fa '.Lang::get('sidebar-nav.link_icon_users_view'), Lang::get('sidebar-nav.link_title_users_view'), array('title' => Lang::get('sidebar-nav.link_title_users_view'))) !!}
                        {{--   <a href="/users">
                            <i class="fa {{ Lang::get('sidebar-nav.link_icon_users_view') }}"></i>
                            <span>
                              {{ Lang::get('sidebar-nav.link_title_users_view') }}
                            </span>
                            <small class="label pull-right bg-blue">
                              {{$total_users}}
                            </small>
                          </a> --}}
                    </li>
                  <li>
                      {!! HTML::icon_link( "/edit-users/", 'fa '.Lang::get('sidebar-nav.link_icon_users_edit'), Lang::get('sidebar-nav.link_title_users_edit'), array('title' => Lang::get('sidebar-nav.link_title_users_edit'))) !!}
                  </li>
                  <li>
                    {!! HTML::icon_link( "/users/create", 'fa '.Lang::get('sidebar-nav.link_icon_user_create'), Lang::get('sidebar-nav.link_title_user_create'), array('title' => Lang::get('sidebar-nav.link_title_user_create'))) !!}
                  </li>
                </ul>
            </li>

          @endif

            <li class="header"></li>

            <li>
                {!! HTML::icon_link( "/logout", 'fa '.Lang::get('sidebar-nav.link_icon_logout'), "<span>".Lang::get('sidebar-nav.link_title_logout')."</span>", array('title' => Lang::get('sidebar-nav.link_title_logout'))) !!}
            </li>
            {{--
                  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-files-o"></i>
                      <span>Layout Options</span>
                      <span class="label label-primary pull-right">4</span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                      <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                      <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                      <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
                    </ul>
                  </li>

            --}}
            {{--
          <li>
            <a href="pages/widgets.html">
              <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
            </a>
          </li>
          --}}
          {{--

          <li class="treeview">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>Charts</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
              <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
              <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
              <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
            </ul>
          </li>


          <li class="treeview">
            <a href="#">
              <i class="fa fa-laptop"></i>
              <span>UI Elements</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
              <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
              <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
              <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
              <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
              <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
            </ul>
          </li>



          <li class="treeview">
            <a href="#">
              <i class="fa fa-edit"></i> <span>Forms</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
              <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
              <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
            </ul>
          </li>



          <li class="treeview">
            <a href="#">
              <i class="fa fa-table"></i> <span>Tables</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
              <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
            </ul>
          </li>



          <li>
            <a href="pages/calendar.html">
              <i class="fa fa-calendar"></i> <span>Calendar</span>
              <small class="label pull-right bg-red">3</small>
            </a>
          </li>



          <li>
            <a href="pages/mailbox/mailbox.html">
              <i class="fa fa-envelope"></i> <span>Mailbox</span>
              <small class="label pull-right bg-yellow">12</small>
            </a>
          </li>



          <li class="treeview">
            <a href="#">
              <i class="fa fa-folder"></i> <span>Examples</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
              <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
              <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
              <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
              <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
              <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
              <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
              <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            </ul>
          </li>



          <li class="treeview">
            <a href="#">
              <i class="fa fa-share"></i> <span>Multilevel</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              <li>
                <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                  <li>
                    <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                      <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            </ul>
          </li>


            <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
            --}}

        </ul>
    </section>
</aside>