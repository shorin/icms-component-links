<?php
	if(!defined('VALID_CMS_ADMIN')) { die('ACCESS DENIED'); }
	
	cpAddPathway('Ссылки', '?view=components&do=config&id='.$_REQUEST['id']);
	
	echo '<h3>Ссылки</h3>';
	
	if (isset($_REQUEST['opt'])) { $opt = $_REQUEST['opt']; } else { $opt = 'list'; }
	
	$toolmenu = array();
	$toolmenu[0]['icon'] = 'save.gif';
	$toolmenu[0]['title'] = 'Сохранить';
	$toolmenu[0]['link'] = 'javascript:document.optform.submit();';
	$toolmenu[1]['icon'] = 'cancel.gif';
	$toolmenu[1]['title'] = 'Отмена';
	$toolmenu[1]['link'] = '?view=components';
	cpToolMenu($toolmenu);
	
	$cfg = $inCore->loadComponentConfig('links');
	
	if($opt=='saveconfig'){	
		$cfg = array();
		$cfg['prosmotr'] = $_REQUEST['prosmotr'];
		$cfg['poisk'] = $_REQUEST['poisk'];
		$inCore->saveComponentConfig('links', $cfg);
		$msg = 'Настройки сохранены.';
	}
	
	global $_CFG;
	
	if (@$msg) { echo '<p class="success">'.$msg.'</p>'; }
?>
	<form action="index.php?view=components&amp;do=config&amp;id=<?php echo $_REQUEST['id'];?>" method="post" name="optform" target="_self" id="form1">
		<table width="100%" border="0" cellpadding="10" cellspacing="0" class="proptable">
			<tr>
				<td>Просмотр ссылок: </td>
				<td valign="top">
					<select name="prosmotr" id="name_mode" style="width:300px">
						<option value="1">только администраторам</option>
						<option value="2">зарегистрированным</option>
						<option value="3">всем</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Поисковая строка: </td>
				<td valign="top">
					<select name="poisk" id="name_mode" style="width:300px">
						<option value="1">гугл</option>
						<option value="2">яндекс</option>
					</select>
				</td>
			</tr>
		</table>
		<p>
			<input name="opt" type="hidden" value="saveconfig" />
			<input name="save" type="submit" id="save" value="Сохранить" />
			<input name="back" type="button" id="back" value="Отмена" onclick="window.location.href='index.php?view=components';"/>
		</p>
	</form>