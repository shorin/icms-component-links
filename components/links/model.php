<?php

	if(!defined('VALID_CMS')) { die('ACCESS DENIED'); }
	
	class cms_model_links{
		
		public  $config = array();
		private static $instance;
		
		function __construct(){
			$this->inDB = cmsDatabase::getInstance();
			$this->config = self::getConfig();
		}
		
		public function install(){
			return true;
		}
		
		public static function getInstance() {
			if (self::$instance === null) {
				self::$instance = new self;
			}
			return self::$instance;
		}
		
		public static function getDefaultConfig(){
			$cfg = array(
						'prosmotr'=>'3',
						'poisk'=>'1'
			);
			return $cfg;
		}
		
		public static function getConfig(){
			$inCore = cmsCore::getInstance();
			$default_cfg = self::getDefaultConfig();
			$cfg = $inCore->loadComponentConfig('links');
			$cfg = array_merge($default_cfg, $cfg);
			return $cfg;
		}
		
		public function updateLink($id, $url, $rewrite, $img, $color, $scale){
			$sql = "UPDATE cms_links SET url = '{$url}', rewrite = '{$rewrite}', img = '{$img}', color = '{$color}', scale = '{$scale}' WHERE id = '{$id}'";
			$this->inDB->query($sql);
			if ($this->inDB->error()){return false;}
			return true;
		}
		
		public function getLink($id){
			$sql = "SELECT * FROM cms_links WHERE id = '{$id}'";
			$result = $this->inDB->query($sql);
			if (!$this->inDB->num_rows($result)){return false;}
			$links = array();
			while ($data = $this->inDB->fetch_assoc($result)){
				$links[] = $data;
			}
			return $links;
		}
		
		public function getLinks($num){
			$sql = "SELECT * FROM cms_links LIMIT ".$num." , 12";
			$result = $this->inDB->query($sql);
			if (!$this->inDB->num_rows($result)){return false;}
			$links = array();
			while ($data = $this->inDB->fetch_assoc($result)){
				$data['num'] = $data['id'] - $num;
				$links[] = $data;
			}
			return $links;
		}
		
		public function tumbs($dir){
			$thumbs = array();
			if ($handle = opendir($dir)){
				while (false !== ($file = readdir($handle))){
					if ($file != '.' && $file != '..' && $file != 'add.png'){
						$sql = "SELECT img FROM cms_links WHERE img = '{$file}' LIMIT 1";
						$result = $this->inDB->query($sql);
						if (!$this->inDB->num_rows($result)){
							$thumb['file'] = $file;
							$array = GetImageSize($dir.'/'.$thumb['file']);
							$thumb['width'] = $array['0'];
							$thumb['height'] = $array['1'];
							$thumbs[] = $thumb;
						}
					}
				}
				closedir($handle);
			}
			return $thumbs;
		}
		
		public function getVkladka($number){
			$sql = "SELECT * FROM cms_links_name WHERE id = '{$number}' LIMIT 1";
			$result = $this->inDB->query($sql);
			if (!$this->inDB->num_rows($result)){return false;}
			$vkladka = array();
			$data = $this->inDB->fetch_assoc($result);
			$vkladka[] = $data;
			return $vkladka;
		}
		
		public function addVkladka($name, $privat){
			$sql = "INSERT INTO cms_links_name (name, privat) VALUES ('{$name}', '{$privat}')";
			$this->inDB->query($sql);
			if ($this->inDB->error()){return false;}
			$konec = 0;
			while ($konec != 12){
				$sql = "INSERT INTO cms_links (url, rewrite, img, color, scale) VALUES ('', '1', 'add.png', '#000', '0')";
				$this->inDB->query($sql);
				$konec++;
			}
			$sql = "SELECT id FROM cms_links_name ORDER BY id DESC LIMIT 1";
			$result = $this->inDB->query($sql);
			if (!$this->inDB->num_rows($result)){return false;}
			$data = $this->inDB->fetch_assoc($result);
			$id = $data['id'];
			return $id;
		}
		
		public function vkladkanum($link_id){
			$chislo = 12;
			$vkladka = 1;
			while ($chislo < $link_id){
				$chislo = $chislo + 12;
				$vkladka++;
			}
			if ($vkladka == 1){return '/links';}
			return '/links/'.$vkladka;
		}
		
		public function getVkladki(){
			$sql = "SELECT * FROM cms_links_name";
			$result = $this->inDB->query($sql);
			if (!$this->inDB->num_rows($result)){return false;}
			$vkladki = array();
			while ($data = $this->inDB->fetch_assoc($result)){
				$vkladki[] = $data;
			}
			return $vkladki;
		}
		
		public function editVkladka($id, $name, $privat){
			$sql = "UPDATE cms_links_name SET name = '{$name}', privat = '{$privat}' WHERE id = '{$id}'";
			$result = $this->inDB->query($sql);
			if (!$this->inDB->num_rows($result)){return false;}
			return true;
		}
	}
?>