<?php
	function links(){
		
		define('PATH', $_SERVER['DOCUMENT_ROOT']);
		
		$inCore = cmsCore::getInstance();
		$inPage = cmsPage::getInstance();
		$inDB = cmsDatabase::getInstance();
		$inUser = cmsUser::getInstance();
		
		$inCore->loadModel('links');
		$model = new cms_model_links();
		
		$cfg = $model->getConfig();
		if(!$cfg['component_enabled']){cmsCore::error404();}
		
		$do	= $inCore->request('do', 'str', 'links');
		
		if (!isset($cfg['prosmotr'])){$cfg['prosmotr'] = 1;}
		if (!isset($cfg['poisk'])){$cfg['poisk'] = 1;}
		
		if ($cfg['prosmotr'] == 1){
			if (!$inUser->is_admin){cmsCore::error404();}
		}
		if ($cfg['prosmotr'] == 2){
			if (!$inUser->id){cmsCore::error404();}
		}
		
		
		if ($do == 'links'){
			$number = $inCore->request('vkladka', 'int', '1');
			$vkladka = $model->getVkladka($number);
			$inPage->setTitle("Ссылки");
			if ($number == 1){
				$inPage->addPathway('Ссылки', '/links');
			}
			else{
				$inPage->addPathway('Ссылки', '/links/'.$number);
			}
			if ($vkladka[0][privat] == 1 && !$inUser->is_admin){cmsCore::error404();}
			$number = ($number - 1) * 12;
			$links = $model->getLinks($number);
			$vkladki = $model->getVkladki();
			if (!$links || !$vkladka){cmsCore::error404();}
			
			$smarty = $inCore->initSmarty('components', 'com_links.tpl');
			$smarty->assign('links', $links);
			$smarty->assign('vkladka', $vkladka);
			$smarty->assign('vkladki', $vkladki);
			$smarty->assign('is_admin', $inUser->is_admin);
			$smarty->assign('rewrite', 'http://'.$inCore->getHost().'/go/url=');
			$smarty->assign('cfg', $cfg);
			$smarty->display('com_links.tpl');
			return true;
		}
		
		if ($do == 'edit'){
			if (!$inUser->is_admin){$inCore->redirect('/links');}
			$is_send = $inCore->inRequest('savelink');
			$is_clear = $inCore->inRequest('clearlink');
			$link_id = $inCore->request('editlink', 'int');
			if ($is_send){
				$link_url = $inCore->request('url', 'str');
				$link_rewrite = $inCore->request('rewrite', 'int');
				$link_thumb = $inCore->request('thumb', 'str');
				$link_color = $inCore->request('color', 'str');
				$link_scale = $inCore->request('scale', 'int');
				$model->updateLink($link_id, $link_url, $link_rewrite, $link_thumb, $link_color, $link_scale);
				$adressvkladki = $model->vkladkanum($link_id);
				$inCore->redirect($adressvkladki);
			}
			if ($is_clear){
				$model->updateLink($link_id, '', '1', 'add.png', '#000', '0');
				$adressvkladki = $model->vkladkanum($link_id);
				$inCore->redirect($adressvkladki);
			}
			$inPage->setTitle("Редактирование ссылки");
			$inPage->addPathway('Редактирование ссылки', '/links/edit'.$link_id);
			$thumbs = $model->tumbs(PATH.'/components/links/thumbs');
			$link = $model->getLink($link_id);
			
			$smarty = $inCore->initSmarty('components', 'com_links_edit.tpl');
			$smarty->assign('link', $link);
			$smarty->assign('thumbs', $thumbs);
			$smarty->display('com_links_edit.tpl');
			return true;
		}
		
		if ($do == 'add'){
			if (!$inUser->is_admin){$inCore->redirect('/links');}
			$inPage->setTitle("Добавление вкладки");
			$inPage->addPathway('Добавление вкладки', '/add');
			$is_send = $inCore->inRequest('save');
			if ($is_send){
				$vkladka_name = $inCore->request('name', 'str');
				$vkladka_privat = $inCore->request('privat', 'int');
				$id = $model->addVkladka($vkladka_name, $vkladka_privat);
				$inCore->redirect('/links/'.$id);
			}
			$vkladka['0'] = array(
								'name'=>'',
								'privat'=>''
							);
			
			$smarty = $inCore->initSmarty('components', 'com_links_add.tpl');
			$smarty->assign('is_admin', $inUser->is_admin);
			$smarty->assign('vkladka', $vkladka);
			$smarty->display('com_links_add.tpl');
			return true;
		}
		
		if ($do == 'vkladka_edit'){
			if (!$inUser->is_admin){$inCore->redirect('/links');}
			$vkladka_id = $inCore->request('vkladka_edit', 'int');
			$vkladka = $model->getVkladka($vkladka_id);
			$inPage->setTitle("Редактирование вкладки");
			$inPage->addPathway('Редактирование вкладки', '/links/vkladka_edit'.$vkladka_id); 
			$is_send = $inCore->inRequest('save');
			if ($is_send){
				$vkladka_name = $inCore->request('name', 'str');
				$vkladka_privat = $inCore->request('privat', 'int');
				$model->editVkladka($vkladka_id, $vkladka_name, $vkladka_privat);
				$inCore->redirect('/links/'.$vkladka_id);
			}
			
			$smarty = $inCore->initSmarty('components', 'com_links_add.tpl');
			$smarty->assign('is_admin', $inUser->is_admin);
			$smarty->assign('vkladka', $vkladka);
			$smarty->display('com_links_add.tpl');
			return true;
		}
		
	}
?>
