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

namespace Classes\Main;
class Debug implements \Config\System {

	private $errorCount, $errors;

	public function __construct() {
		$this->errorCount = 0;
		$this->errors = '';
	}

	public function error($exception) {
		$msg = $exception->getMessage();

		switch (\Config\System::SYSTEM_DEBUG_LEVEL) {
			case 0: break;
			case 1: 
				try {
					$file;
					if (!($file = fopen(\Config\System::SYSTEM_LOG_FILE, 'a+'))) throw new Exception("error.log konnte nicht ge&ouml;ffnet werden. Permission denied", 1);
					fputs($file, "[ERROR] ".$msg."\n");
					fclose($file);
			    } catch (\Exception $e) {
				$this->errors .= sprintf("[ERROR] error.log konnte nicht ge&ouml;ffnet werden. Permission denied\n");
				$this->errorCount++;
			}
			break;

			case 2: 
				try {
					$file;
					if (!($file = fopen(\Config\System::SYSTEM_LOG_FILE, 'a+'))) throw new Exception("error.log konnte nicht ge&ouml;ffnet werden. Permission denied", 1);
					fputs($file, "[ERROR] ".$msg."\n");
					fclose($file);
					$this->errors .= sprintf("[ERROR] %s\n",$msg);
					$this->errorCount++;
				} catch (\Exception $e) {
					$this->errors .= sprintf("[ERROR] error.log konnte nicht ge&ouml;ffnet werden. Permission denied\n");
					$this->errorCount++;
				}
			break;
		}
	}

	public function hasError() {
		return $this->errorCount > 0;
	}

	public function getError() {
		return $this->errors;
	}
}

?>