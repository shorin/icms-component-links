<?php
	
	function info_component_links(){
		$_component['title']        = 'Ссылки';
		$_component['description']  = 'Компонент ссылки для Вашего сайта';
		$_component['link']         = 'links';
		$_component['author']       = 'maix';
		$_component['internal']     = '0';
		$_component['version']      = '1.0';
		
		$inCore = cmsCore::getInstance();
		$inCore->loadModel('links');
		$_component['config'] = cms_model_links::getConfig();
		
		return $_component;
	}
	
	function install_component_links(){
		$inCore = cmsCore::getInstance();
		$inDB  = cmsDatabase::getInstance();
		$inConf = cmsConfig::getInstance();
		include($_SERVER['DOCUMENT_ROOT'].'/includes/dbimport.inc.php');
		dbRunSQL($_SERVER['DOCUMENT_ROOT'].'/components/links/install.sql', $inConf->db_prefix);
		return true; 
	}
	
	function upgrade_component_links(){
		return true;
	}

?>