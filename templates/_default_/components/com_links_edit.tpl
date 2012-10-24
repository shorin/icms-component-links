<link rel="stylesheet" type="text/css" href="/components/links/css/links.css"/>

<form id="addform" name="addform" method="post" action="" enctype="multipart/form-data">
	<div style="background: #250040;color:#fff; padding:10px;">
		{foreach item=linkdata from=$link}
			<div style="float:left" class="links_span">Адрес ссылки</div>
			<div>
				<input name="url" type="text" style="width:300px;margin-bottom:5px;" value="{$linkdata.url}" />
			</div>
			<div style="float:left" class="links_span">Цвет блока</div>
			<div>
				<input name="color" type="text" style="width:300px;margin-bottom:5px;" value="{$linkdata.color}" />
			</div>
			<div style="float:left" class="links_span">Сделать внутренней ссылкой</div>
			<div>
				<input name="rewrite" type="checkbox" style="margin-bottom:5px;" value="1" {if $linkdata.rewrite == 1}checked="checked"{/if} />
			</div>
			<div style="float:left" class="links_span">Масштабировать изображение</div>
			<div>
				<input name="scale" type="checkbox" style="margin-bottom:5px;" value="1" {if $linkdata.scale == 1}checked="checked"{/if} />
			</div>
			<div style="padding:10px 0px 20px 250px;">
				<button name="savelink" id="" class="" />Сохранить</button>
				<button name="clearlink" id="" class="" />Очистить</button>
				<button name="back" id="" class="" onclick="window.history.back();"/>Назад</button>
			</div>
			{foreach item=thumb from=$thumbs}
				<div style="margin 5px; width: {$thumb.width}px; height: {$thumb.height}px; background: url('/components/links/thumbs/{$thumb.file}') no-repeat #250040;" >
					<input type="radio" name="thumb" value="{$thumb.file}" />
				</div>
			{/foreach}
		{/foreach}
	</div>
</form>