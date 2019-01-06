<header class="mdl-layout__header mdl-layout__header--scroll mdl-color--primary">
	<div class="mdl-layout--lang mdl-layout__header-row">
	</div>
	<div class="mdl-layout-logo mdl-layout__header-row">
	  <a class="" href="/"><img src="../../../images/logo.png" class="img-responsive"></a>
	</div>
	<div class="mdl-layout__tab-bar mdl-layout__header-row external-menubar">
		<a href="" class="mdl-layout__tab menu-link">Welcome</a>
		<a href="" class="mdl-layout__tab menu-link">Decide</a>
		<a href="" class="mdl-layout__tab menu-link is-active">Research</a>
		<a href="" class="mdl-layout__tab menu-link">About</a>
		<a href="" class="mdl-layout__tab menu-link">Blog</a>
		<a href="" class="mdl-layout__tab menu-link">Donate</a>
	</div>
	<div class="mdl-layout__tab-bar mdl-js-ripple-effect mdl-color--primary-dark">
	  <a href="/organizations" class="mdl-layout__tab @if(Request::is ('organizations')) is-active @endif">Organizations</a>
	  <a href="/projects" class="mdl-layout__tab @if(Request::is ('projects')) is-active @endif">Projects</a>
	  <a href="/services" class="mdl-layout__tab @if(Request::is ('services')) is-active @endif">Services</a>
	  <a href="/people" class="mdl-layout__tab @if(Request::is ('people')) is-active @endif">People</a>
	  <a href="/elections" class="mdl-layout__tab @if(Request::is ('elections')) is-active @endif">Elections</a>
	  <a href="/laws" class="mdl-layout__tab @if(Request::is ('laws')) is-active @endif">Laws</a>
	</div>
</header>
