<header class="mdl-layout__header">
	<div class="mdl-layout__header-row">
		<button type="button" id="sidebarCollapse" class="btn mdl-layout__drawer-button" style="padding: 0">
            <i class="material-icons">menu</i>
        </button>
		<span class="mdl-layout-title">@yield('title')</span>
<!-- 		<div class="mdl-layout-spacer"></div> -->
	</div>
</header>


<script type="text/javascript">
	$(document).ready(function(){
		$('.mdl-layout__drawer-button').click(function(){
			$('.mdl-layout__drawer').addClass('is-visible');
			$('.mdl-layout__obfuscator').addClass('is-visible');
		});
		$('.mdl-layout__obfuscator').click(function(){
			$('.mdl-layout__drawer').removeClass('is-visible');
			$('.mdl-layout__obfuscator').removeClass('is-visible');
		});
	});
	
</script>
