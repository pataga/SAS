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

namespace Classes\Main;
class Header {
	private $header = [];

	public function add($header) {
		$this->header[count($this->header)] = $header;
	}

	public function printHeaders() {
		for ($i=0;$i<count($this->header);$i++) {
			header($this->header[$i]);
		}
	}

	public function relocate($url) {
		$this->header[count($this->header)] = 'Location: '.$url;
	}
}

?>
