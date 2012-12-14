<?php

class Cache {
	
	private $cache='';
	private $main;

	public function __construct($main) {
		$this->main = $main;
	}

	public function buildCache($inc) {
		$loader = $this->main->getLoaderInstance();
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
		} catch (Exception $e) {
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
		} catch (Exception $e) {
			$this->main->getDebugInstance()->error($e);
			return '';
		}
	}

	public function getCache() {
		return $this->cache;
	}
}

?>