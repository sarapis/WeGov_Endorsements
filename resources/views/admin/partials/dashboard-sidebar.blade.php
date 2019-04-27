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
            <li>
                <a href="/appearance" title="Appearance"><i class="fa fa-desktop" aria-hidden="true"></i><span>Appearance</span></a>
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
              <a href="/tb_organizations">
                <i class="fa fa-table"></i>
                <span>Index Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
<!--                 <li><a href="/tb_projects"><i class="fa fa-circle-o"></i> Projects </a></li>
                <li><a href="/tb_commitments"><i class="fa fa-circle-o"></i> Commitments </a></li>
                <li><a href="/tb_expense"><i class="fa fa-circle-o"></i> Expense </a></li>
                <li><a href="/tb_organization"><i class="fa fa-circle-o"></i> Organization </a></li> -->
                <li><a href="/tb_organizations"><i class="fa fa-circle-o"></i> Organization Index</a></li>
<!--                 <li><a href="/tb_contacts"><i class="fa fa-circle-o"></i> Contacts </a></li>
                <li><a href="/tb_services"><i class="fa fa-circle-o"></i> Services </a></li>
                <li><a href="/tb_locations"><i class="fa fa-circle-o"></i> Locations </a></li>
                <li><a href="/tb_address"><i class="fa fa-circle-o"></i> Address </a></li>
                <li><a href="/tb_phones"><i class="fa fa-circle-o"></i> Phones </a></li>
                <li><a href="/tb_schedule"><i class="fa fa-circle-o"></i> Schedule </a></li>
                <li><a href="/tb_programs"><i class="fa fa-circle-o"></i> Programs </a></li>
                <li><a href="/tb_taxonomy"><i class="fa fa-circle-o"></i> Taxonomy </a></li>
                <li><a href="/tb_details"><i class="fa fa-circle-o"></i> Details </a></li>
                <li><a href="/tb_greenbook"><i class="fa fa-circle-o"></i> Greenbook </a></li> -->
              </ul>
            </li>

            <li class="treeview">
              <a href="/tb_greenbook">
                <i class="fa fa-table"></i>
                <span>Joined Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/tb_greenbook"><i class="fa fa-circle-o"></i> Greenbook </a></li>
                <li><a href="/tb_jobs"><i class="fa fa-circle-o"></i> Jobs </a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="/entity_main">
                <i class="fa fa-table"></i>
                <span>Menus</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/entity_main"><i class="fa fa-circle-o"></i> Main Menu</a></li>
                <li><a href="/entity_organizations"><i class="fa fa-circle-o"></i> Organization </a></li>
              </ul>
            </li>
            <li>
                <a href="/apis" title="Appearance"><i class="fa fa-window-maximize" aria-hidden="true"></i><span>APIs</span></a>
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

        </ul>
    </section>
</aside>