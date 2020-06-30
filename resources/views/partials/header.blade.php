<header class="mdl-layout__header mdl-layout__header--scroll mdl-color--primary">
<!-- 	<div class="mdl-layout--lang mdl-layout__header-row">
		<div class="container">

		</div>
	</div> -->
	<div class="logo_area">
		<div class="container" id="logo_area_container">
			<div class="border_bottom">
				<a class="logo_left" href="/">  
					<img src="/upload/images/1560348477.png" class="img-responsive d-inline">   
				</a>
				<!-- start main menu area -->
				<div class="main_menu">
					<ul class="external_menubar">
						<li class="dropdown">
							<a class="dropdown-toggle menu_link is-active" data-toggle="dropdown" href="javascript:void(0)" aria-expanded="false">
								<span>Advocacy</span>
							</a>
							<ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 43px, 0px);">
								<li><a href="https://wegov.nyc/211-4-nyc/" class="menu_link">Searchable Safety Net</a></li>
								<li><a href="https://wegov.nyc/open-engaging-effective-government/" class="menu_link">Digital Transformation</a></li>
								<li><a href="https://wegov.nyc/nymeta/" class="menu_link">Metro-Regional Leadership</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle menu_link" data-toggle="dropdown" href="javascript:void(0)" aria-expanded="false"><span>Tools</span></a>
							<ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 43px, 0px);">
								<li><a href="http://capital.research.wegov.nyc/" class="menu_link">Capital Projects Directory</a></li>
								<li><a href="http://services.wegov.nyc" class="menu_link">Services Directory &amp; API</a></li>
								<li><a href="http://nyclaws.readthedocs.io/" class="menu_link">Charter, Code &amp; Rules</a></li>
								<li><a href="https://maps.wegov.nyc/" class="menu_link">Maps</a></li>
								<li><a href="https://wegov.nyc/action/" class="menu_link">The Action App!</a></li>
							</ul>
						</li>
						<li><a href="https://wegov.nyc/news/" class="menu_link"><span>Community</span></a></li>
						<li><a href="https://wegov.nyc/blog/" class="menu_link"><span>Blog</span></a></li>
						<li><a href="https://opencollective.com/wegovnyc" class="menu_link"><span>Donate</span></a></li>
						<li><a href="https://wegov.nyc/contact/" class="menu_link"><span>Contact</span></a></li>
					</ul>
				</div>
				<!-- end main menu area -->
				<!-- <a class="nav-link " id="google_translate_element"></a> -->
				<div class="top-bar-right">
					<button type="button" onclick="openNav()" class="btn btn-raised btn-block btn-primary menu_filter">
						<!-- <img src="resources/menu.svg" alt="" title="">Menu  -->
						Menu
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="responsive_menu">
		<div class="container">
			<a href="/elections" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 9) == 'elections') is-active @endif">Elections</a>
			<a href="/endorsers" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 9) == 'endorsers') is-active @endif">Endorsers</a>
			<a href="/offices" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 7) == 'offices') is-active @endif">Offices</a>
			<a href="/candidates/588" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 10) == 'candidates') is-active @endif">Candidates</a>
			<a href="https://voters.wegov.nyc/app/" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 9) == 'nycvoters') is-active @endif">Voters</a>
		</div>
	</div>
	<div class="mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--primary-dark submenu_div">
		<div class="container">
			<a href="/elections" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 9) == 'elections') is-active @endif">Elections</a>
			<a href="/endorsers" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 9) == 'endorsers') is-active @endif">Endorsers</a>
			<a href="/offices" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 7) == 'offices') is-active @endif">Offices</a>
			<a href="/candidates" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 10) == 'candidates') is-active @endif">Candidates</a>
			<a href="https://voters.wegov.nyc/app/" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 9) == 'nycvoters') is-active @endif">Voters</a>
		</div>
	</div>
</header>

<header id="main_heading">
    <div class="container">
        <h1 class="page-title">New York City Election Resources</h1>
    </div>
</header>