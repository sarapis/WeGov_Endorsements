<header class="mdl-layout__header mdl-layout__header--scroll mdl-color--primary">
	<div class="mdl-layout--lang mdl-layout__header-row">
		<div class="container">

		</div>
	</div>
	<div class="mdl-layout-logo mdl-layout__header-row">
		<div class="container">
	  	<a class="logo_left" href="/"><img src="{{URL::asset('images/logo1.png')}}" class="img-responsive"></a>
	      <div class="top-bar-right">
	      	<button type="button" class="btn btn-raised btn-block btn-primary menu_filter">
		        <i class="fa fa-bars" aria-hidden="true"></i> Menu 
		    </button>
			<ul class="register_button">
				<li>
					<a href="#">Sign in</a>
				</li>
				<li>
					<a class="button" href="#">Register</a>
				</li>
			</ul>
	      </div>
		</div>
	</div>
	<div class="responsive_menu">
		<div class="container">
			<a href="#" class="mdl-layout__tab menu-link">Sign in</a>
			<a href="#" class="mdl-layout__tab menu-link">Register</a>
			<a href="" class="mdl-layout__tab menu-link">Welcome</a>
			<a href="" class="mdl-layout__tab menu-link">Decide</a>
			<a href="" class="mdl-layout__tab menu-link  is-active">Research</a>
			<a href="" class="mdl-layout__tab menu-link">About</a>
			<a href="" class="mdl-layout__tab menu-link">Blog</a>
			<a href="" class="mdl-layout__tab menu-link">Donate</a>
			<a href="/organizations" class="mdl-layout__tab menu-link @if(Request::is ('organizations')) is-active @endif">Organizations</a>
			<a href="/projects" class="mdl-layout__tab menu-link @if(Request::is ('projects')) is-active @endif">Projects</a>
			<a href="/services" class="mdl-layout__tab menu-link @if(Request::is ('services')) is-active @endif">Services</a>
			<a href="/people" class="mdl-layout__tab menu-link @if(Request::is ('people')) is-active @endif">People</a>
			<a href="/elections" class="mdl-layout__tab menu-link @if(Request::is ('elections')) is-active @endif">Elections</a>
			<a href="/laws" class="mdl-layout__tab menu-link @if(Request::is ('laws')) is-active @endif">Laws</a>
		</div>
	</div>



	<div class="mdl-layout__tab-bar mdl-layout__header-row external-menubar ">
		<div class="container">
			<a href="" class="mdl-layout__tab menu-link">Welcome</a>
			<a href="" class="mdl-layout__tab menu-link">Decide</a>
			<a href="" class="mdl-layout__tab menu-link  is-active">Research</a>
			<a href="" class="mdl-layout__tab menu-link">About</a>
			<a href="" class="mdl-layout__tab menu-link">Blog</a>
			<a href="" class="mdl-layout__tab menu-link">Donate</a>
		</div>
	</div>
	<div class="mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--primary-dark submenu_div">
		<div class="container">
			<a href="/organizations" class="mdl-layout__tab @if(Request::is ('organizations')) is-active @endif">Organizations</a>
			<a href="/projects" class="mdl-layout__tab @if(Request::is ('projects')) is-active @endif">Projects</a>
			<a href="/services" class="mdl-layout__tab @if(Request::is ('services')) is-active @endif">Services</a>
			<a href="/people" class="mdl-layout__tab @if(Request::is ('people')) is-active @endif">People</a>
			<a href="/elections" class="mdl-layout__tab @if(Request::is ('elections')) is-active @endif">Elections</a>
			<a href="/laws" class="mdl-layout__tab @if(Request::is ('laws')) is-active @endif">Laws</a>
		</div>
	</div>
</header>
