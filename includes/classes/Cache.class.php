<?php


/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
* @author Patrick Farnkopf
*
*/


class Cache {
	
	private $cache='';
	private $main;

	public function __construct($main) {
		$this->main = $main;
	}

	public function buildCache($inc) {
		$loader = $this->main->Loader();
		$this->cache .= self::loadTop();
		$this->cache .= $loader->loadMenues();
		$this->cache .= $inc;
		$this->cache .= self::loadFooter();
	}

	static function loadTop() {
		try {
			ob_start();
			require_once 'includes/content/main/top.inc.php';
			$content = ob_get_contents();
			ob_end_clean(); 
			return $content;
		} catch (\Exception\MException $e) {
			$this->main->getDebugInstance()->error($e);
			return '';
		}
	}

	static function loadFooter() {
		try {
			ob_start();
			require_once 'includes/content/main/footer.inc.php';
			$content = ob_get_contents();
			ob_end_clean();
			return $content;
		} catch (\Exception\MException $e) {
			$this->main->getDebugInstance()->error($e);
			return '';
		}
	}

	public function getCache() {
		return $this->cache;
	}
}

?>