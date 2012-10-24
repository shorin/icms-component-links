<link rel="stylesheet" type="text/css" href="/components/links/css/links.css"/>
<form id="addform" name="addform" method="post" action="" enctype="multipart/form-data">
	<div class="links">
		{foreach item=vkd from=$vkladka}
			<div style="float:left" class="links_span">Название вкладки</div>
			<div>
				<input name="name" type="text" style="width: 300px;" value="{$vkd.name}" />
			</div>
			{if $vkd.id != 1}
				<div style="float:left" class="links_span">Приватная</div>
				<div>
					<input name="privat" type="checkbox" value="1" {if $vkd.privat == 1}checked="checked"{/if}/>
				</div>
			{/if}
		{/foreach}
		<div style="padding:10px 0px 0px 250px;">
			<button name="save" id="" class="" />Сохранить</button>
			<button name="back" id="" class="" onclick="window.history.back();"/>Назад</button>
		</div>
	</div>
</form>