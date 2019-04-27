<header class="mdl-layout__header mdl-layout__header--scroll mdl-color--primary">
<!-- 	<div class="mdl-layout--lang mdl-layout__header-row">
		<div class="container">

		</div>
	</div> -->
	<div class="mdl-layout-logo mdl-layout__header-row">
		<div class="container">
	  	<a class="logo_left" href="/">@if($layout->find(1)->action ==1 ) <p class="d-inline site-name">{{$layout->find(1)->link}}</p> @endif @if($layout->find(3)->action ==1 ) <img src="/upload/images/{{$layout->find(3)->link}}" class="img-responsive d-inline"> @endif @if($layout->find(2)->action ==1 ) <p class="d-inline site-name">{{$layout->find(2)->link}}</p> @endif </a>
	      <div class="top-bar-right">
	      	<button type="button" class="btn btn-raised btn-block btn-primary menu_filter">
		        <i class="fa fa-bars" aria-hidden="true"></i> Menu 
		    </button>
			<ul class="register_button">
				<li>
					<a href="http://mygov.nyc/account">Sign in</a>
				</li>
				<li>
					<a class="button" href="http://mygov.nyc/account">Register</a>
				</li>
			</ul>
	      </div>
		</div>
	</div>
	<div class="responsive_menu">
		<div class="container">
			<a href="#" class="mdl-layout__tab menu-link">Sign in</a>
			<a href="#" class="mdl-layout__tab menu-link">Register</a>
			<a href="http://mygov.nyc/" class="mdl-layout__tab menu-link">Welcome</a>
			<a href="http://mygov.nyc/legislation/processes" class="mdl-layout__tab menu-link">Decide</a>
			<a href="/" class="mdl-layout__tab menu-link  is-active">Research</a>
			<div class="tab_filter_btn menu_btn">
                <ul class="nav nav-tabs nav-menu" role="tablist">
                    @if($menu->find(1)->action ==1)<li><a href="/organizations" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 12) == 'organization') is-active @endif">Organizations</a></li>@endif
						@if($menu->find(2)->action ==1)<li><a href="/projects" class="mdl-layout__tab @if(Request::is ('projects')) is-active @endif">Projects</a></li>@endif
						@if($menu->find(3)->action ==1)<li><a href="/services" class="mdl-layout__tab @if(Request::is ('services')) is-active @endif">Services</a></li> @endif
						@if($menu->find(4)->action ==1) <li><a href="/people" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 6) == 'people') is-active @endif">People</a></li> @endif
						@if($menu->find(5)->action ==1) <li><a href="/jobs" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 4) == 'jobs') is-active @endif">Jobs</a></li> @endif
						@if($menu->find(6)->action ==1) <li><a href="/elections" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 9) == 'elections') is-active @endif">Elections</a></li> @endif
						@if($menu->find(7)->action ==1) <li><a href="/laws" class="mdl-layout__tab @if(Request::is ('laws')) is-active @endif">Laws</a></li> @endif
						@if($menu->find(8)->action ==1) <li><a href="/about" class="mdl-layout__tab @if(Request::is ('about')) is-active @endif">About</a></li> @endif
					
                </ul>
            </div>
			<a href="http://mygov.nyc/about" class="mdl-layout__tab menu-link">About</a>
			<a href="http://mygov.nyc/blog/" class="mdl-layout__tab menu-link">Blog</a>
			<a href="https://opencollective.com/mygovnyc" class="mdl-layout__tab menu-link">Donate</a>
			<a href="http://blog.mygov.nyc/get-involved/" class="mdl-layout__tab menu-link">Get Involved</a>
			@if($menu->find(1)->action ==1) <a href="/organizations" class="mdl-layout__tab menu-link @if(mb_substr(Request::segment(1), 0, 12) == 'organization') is-active @endif">Organizations</a> @endif
			@if($menu->find(2)->action ==1) <a href="/projects" class="mdl-layout__tab menu-link @if(Request::is ('projects')) is-active @endif">Projects</a> @endif
			@if($menu->find(3)->action ==1) <a href="/services" class="mdl-layout__tab menu-link @if(Request::is ('services')) is-active @endif">Services</a> @endif
			@if($menu->find(4)->action ==1) <a href="/people" class="mdl-layout__tab menu-link @if(mb_substr(Request::segment(1), 0, 6) == 'people') is-active @endif">People</a> @endif
			@if($menu->find(5)->action ==1) <a href="/jobs" class="mdl-layout__tab menu-link @if(mb_substr(Request::segment(1), 0, 4) == 'jobs') is-active @endif">Jobs</a> @endif
			@if($menu->find(6)->action ==1) <a href="/elections" class="mdl-layout__tab menu-link @if(mb_substr(Request::segment(1), 0, 9) == 'elections') is-active @endif">Elections</a> @endif
			@if($menu->find(7)->action ==1) <a href="/laws" class="mdl-layout__tab menu-link @if(Request::is ('laws')) is-active @endif">Laws</a> @endif
			@if($menu->find(8)->action ==1) <a href="/about" class="mdl-layout__tab menu-link @if(Request::is ('about')) is-active @endif">About</a> @endif
		</div>
	</div>



	<div class="mdl-layout__tab-bar mdl-layout__header-row external-menubar ">
		<div class="container">
			<a href="http://mygov.nyc/" class="mdl-layout__tab menu-link">Welcome</a>
			<a href="http://mygov.nyc/legislation/processes" class="mdl-layout__tab menu-link">Decide</a>
			<a href="/" class="mdl-layout__tab menu-link  is-active">Research</a>
			<a href="http://mygov.nyc/about" class="mdl-layout__tab menu-link">About</a>
			<a href="http://mygov.nyc/blog/" class="mdl-layout__tab menu-link">Blog</a>
			<a href="https://opencollective.com/mygovnyc" class="mdl-layout__tab menu-link">Donate</a>
			<a href="http://blog.mygov.nyc/get-involved/" class="mdl-layout__tab menu-link">Get Involved</a>
		</div>
	</div>
	<div class="mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--primary-dark submenu_div">
		<div class="container">
			@if($menu->find(1)->action ==1) <a href="/organizations" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 12) == 'organization') is-active @endif">Organizations</a> @endif
			@if($menu->find(2)->action ==1) <a href="/projects" class="mdl-layout__tab @if(Request::is ('projects')) is-active @endif">Projects</a> @endif
			@if($menu->find(3)->action ==1) <a href="/services" class="mdl-layout__tab @if(Request::is ('services')) is-active @endif">Services</a> @endif
			@if($menu->find(4)->action ==1) <a href="/people" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 6) == 'people') is-active @endif">People</a> @endif
			@if($menu->find(5)->action ==1) <a href="/jobs" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 4) == 'jobs') is-active @endif">Jobs</a> @endif
			@if($menu->find(6)->action ==1) <a href="/elections" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 9) == 'elections') is-active @endif">Elections</a> @endif
			@if($menu->find(7)->action ==1) <a href="/laws" class="mdl-layout__tab @if(Request::is ('laws')) is-active @endif">Laws</a> @endif
			@if($menu->find(8)->action ==1) <a href="/about" class="mdl-layout__tab @if(Request::is ('about')) is-active @endif">About</a> @endif
		</div>
	</div>
</header>