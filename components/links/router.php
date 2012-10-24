<?php
	function routes_links(){
		
		$routes[] = array(
						'_uri' 	=> '/^links\/([0-9]+)$/i',
						'do' 	=> 'links',
						1 		=> 'vkladka'
					);
		
		$routes[] = array(
						'_uri' 	=> '/^links\/edit([0-9]+)$/i',
						'do' 	=> 'edit',
						1 => 'editlink'
					);
		
		$routes[] = array(
						'_uri' 	=> '/^links\/add$/i',
						'do' 	=> 'add',
					);
		
		$routes[] = array(
						'_uri' 	=> '/^links\/vkladka_edit([0-9]+)$/i',
						'do' 	=> 'vkladka_edit',
						1 		=> 'vkladka_edit',
					);
		
		return $routes;
	}
?>
