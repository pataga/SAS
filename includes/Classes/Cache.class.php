<?php


/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Patrick Farnkopf
*
*/

namespace Classes;
class Cache extends \Classes\Singleton {
	
	private $cache = '';


	public function buildCache($inc) {
		$loader = self::getInstance('\Classes\Main\Loader');
		$this->cache .= $loader->getMenu();
		$this->cache .= $inc;
		$this->cache .= self::loadFooter();
	}

	static function loadFooter() {
		try {
			ob_start();
			require_once 'includes/Content/main/footer.inc.php';
			$content = ob_get_contents();
			ob_end_clean();
			return $content;
		} catch (\Exception $e) {
			self::getInstance('\Classes\Main\Debug')->error($e);
			return '';
		}
	}

	public function getCache() {
		return $this->cache;
	}
}

?>