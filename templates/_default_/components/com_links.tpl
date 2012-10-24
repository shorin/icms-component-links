<link rel="stylesheet" type="text/css" href="/components/links/css/links.css"/>
<div class="links">
	{foreach item=vkd from=$vkladka}
		<div class="links_name">{$vkd.name}</div>
		{if $is_admin == 1}
			<div class="links_nastr"><a href="/links/vkladka_edit{$vkd.id}" class="links_edit"></a></div>
		{/if}
	{/foreach}
	<div class="links_wrapper">
		{foreach item=link from=$links}
			<div class="thumb{$link.num}" style="background:url('/components/links/thumbs/{$link.img}') no-repeat center {$link.color};{if $link.scale == 1}background-size: contain;{/if}">
				{if $is_admin == 1}
					<a href="/links/edit{$link.id}" class="links_edit"></a>
				{/if}
				{if $link.url}
					<a href="{if $link.rewrite == 1}{$rewrite}{/if}{$link.url}" target="_blank" class="links_a"></a>
				{else}
					{if $is_admin == 1}
						<a href="/links/edit{$link.id}" target="_blank" class="links_a"></a>
					{/if}
				{/if}
			</div>
		{/foreach}
		{if $cfg.poisk == 1}
			<form action="http://www.google.ru/search" method="get" class="links_form">
				<input type="text" name="q" value="" class="links_input" />
			</form>
		{/if}
		{if $cfg.poisk == 2}
			<form action="http://yandex.ru/yandsearch" method="get" class="links_form">
				<input type="text" name="text" value="" class="links_input" />
			</form>
		{/if}
	</div>
	<div style="position:absolute;top:500px;">
		{foreach item=vkladka from=$vkladki}
			{if $vkladka.privat != 1 || $is_admin == 1} 
				<div style="float:left;"><a href="{if $vkladka.id == 1}/links{else}/links/{$vkladka.id}{/if}" class="links_vkladka">{$vkladka.name}</a></div>
			{/if}
		{/foreach}
		{if $is_admin == 1}
			<div>
				<a href="/links/add" class="links_vkladka">+</a>
			</div>
		{/if}
	</div>
</div>