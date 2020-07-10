<header class='mdl-layout__header mdl-layout__header--scroll mdl-color--primary'>
	<div class='mdl-layout-logo mdl-layout__header-row'>
		<div class='container'>
			<div class='border_bottom'>
				<a class='logo_left' href='http://wegov.nyc/'><img src='/upload/images/1560348477.png' class='img-responsive d-inline' /></a>
				<div class="top-bar-right">
					<button type="button" onclick="openNav()" class="btn btn-raised menu_filter">
						Menu
					</button>
				</div>
				<div class='mdl-layout__tab-bar external-menubar main_menu '>
					<ul class='external_menubar'>
						<li class='dropdown'>
							<a href='http://wegov.nyc/news/' class=' menu_link dropdown-toggle' data-toggle='dropdown' aria-expanded='false' href='javascript:void(0)'>
								<span>Advocacy </span>
							</a>
							<ul class='dropdown-menu'>
								<li>
									<a href='https://wegov.nyc/advocacy/safety-net/' class='menu_link'>Searchable Safety Net</a>
								</li>
								<li>
									<a href='https://wegov.nyc/advocacy/digital-government/' class='menu_link'>Digital Government</a>
								</li>
								<li>
									<a href='https://wegov.nyc/advocacy/regional/' class='menu_link'>Regional Leadership</a>
								</li>
							</ul>
						</li>
						<li class='dropdown'>
							<a class='dropdown-toggle menu_link' data-toggle='dropdown' href='javascript:void(0)'><span>Tools</span></a>
							<ul class='dropdown-menu'>
								<li><a href='http://capital.research.wegov.nyc/' class='menu_link'>Capital Projects</a></li>
								<li><a href='http://services.wegov.nyc' class='menu_link'>City Services</a></li>
								<li><a href='http://nyclaws.readthedocs.io/' class='menu_link'>NYC Charter, Code & Rules</a></li>
								<li><a href='http://endorsements.wegov.nyc/' class='menu_link'>Endorsement Directory</a></li>
								<li><a href='https://maps.wegov.nyc/' class='menu_link'>City Maps</a></li>
								<li><a href='https://wegov.nyc/tools/mobile-app/' class='menu_link'>Mobile App</a></li>
							</ul>
						</li>
						<li><a href='https://wegov.nyc/community/' class='menu_link'><span>Community</span></a></li>
						<li><a href='https://wegov.nyc/about/' class='menu_link'><span>About </span></a></li>
						<li><a href='https://wegov.nyc/contact/' class='menu_link'><span>Contact</span></a></li>
						<li><a href='https://opencollective.com/wegovnyc' class='menu_link'><span>Donate</span></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class='responsive_menu'  id='mySidenav'>
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
			<img src="images/close-white.png" alt="" title="">
		</a>
		<ul class='external_menubar'>
			<li class='dropdown'>
				<a class='dropdown-toggle menu_link is-active' data-toggle='dropdown' href='javascript:void(0)'>
					<span>Advocacy</span>
				</a>
				<ul class='dropdown-menu'>
					<li>
						<a href='https://wegov.nyc/advocacy/safety-net/' class='menu_link'>Searchable Safety Net</a>
					</li>
					<li>
						<a href='https://wegov.nyc/advocacy/digital-government/' class='menu_link'>Digital Government</a>
					</li>
					<li>
						<a href='https://wegov.nyc/advocacy/regional/' class='menu_link'>Regional Leadership</a>
					</li>
				</ul>
			</li>
			<li class='dropdown'>
				<a class='dropdown-toggle menu_link' data-toggle='dropdown' href='javascript:void(0)'><span>Tools</span></a>
				<ul class='dropdown-menu'>
					<li><a href='http://capital.research.wegov.nyc/' class='menu_link'>Capital Projects</a></li>
					<li><a href='http://services.wegov.nyc' class='menu_link'>City Services</a></li>
					<li><a href='http://nyclaws.readthedocs.io/' class='menu_link'>NYC Charter, Code & Rules</a></li>
					<li><a href='http://endorsements.wegov.nyc/' class='menu_link'>Endorsement Directory</a></li>
					<li><a href='https://maps.wegov.nyc/' class='menu_link'>City Maps</a></li>
					<li><a href='https://wegov.nyc/tools/mobile-app/' class='menu_link'>Mobile App</a></li>
				</ul>
			</li>
			<li><a href='https://wegov.nyc/community/' class='menu_link'><span>Community</span></a></li>
			<li><a href='https://wegov.nyc/about/' class='menu_link'><span>About </span></a></li>
			<li><a href='https://wegov.nyc/contact/' class='menu_link'><span>Contact</span></a></li>
			<li><a href='https://opencollective.com/wegovnyc' class='menu_link'><span>Donate</span></a></li>
		</ul>
	</div>
	  
	  <div class='mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--primary-dark submenu_div'>
		<div class='container'>
			<span class='badge badge-light title_top_header' >Endorsement Directory</span>
			<a href="/elections" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 9) == 'elections') is-active @endif">Elections</a>
			<a href="/endorsers" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 9) == 'endorsers') is-active @endif">Endorsers</a>
			<a href="/offices" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 7) == 'offices') is-active @endif">Offices</a>
			<a href="/candidates" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 10) == 'candidates') is-active @endif">Candidates</a>
			<a href="https://wegov.nyc/tools/endorsements/" class="mdl-layout__tab @if(mb_substr(Request::segment(1), 0, 9) == 'nycvoters') is-active @endif">About</a>
		</div>
	</div>
</header>

{{-- 
<header class="mdl-layout__header mdl-layout__header--scroll mdl-color--primary">
	<div class="logo_area">
		<div class="container" id="logo_area_container">
			<div class="border_bottom">
				<a class="logo_left" href="/">  
					<img src="/upload/images/1560348477.png" class="img-responsive d-inline">   
				</a>
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
				<div class="top-bar-right">
					<button type="button" onclick="openNav()" class="btn btn-raised btn-block btn-primary menu_filter">
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
			
		</div>
	</div>
</header> --}}

<header id="main_heading">
    <div class="container">
        <h1 class="page-title">New York City Election Resources</h1>
    </div>
</header>

<script>
	function openNav() {
	  document.getElementById("mySidenav").style.width = "250px";
	  // document.getElementById("mySidenav").style.display = "block";
	  
  }

  function closeNav() {
	  document.getElementById("mySidenav").style.width = "0";
	  // document.getElementById("mySidenav").style.display = "none";

  }
</script>