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


class Debug {

	private $loglevel, $logfile, $errorCount, $errors;

	public function __construct($loglevel=2, $logfile='error.log') {
		$this->loglevel = $loglevel;
		$this->logfile = $logfile;
		$this->errorCount = 0;
		$this->errors = '';
	}

	public function error($exception) {
		$msg = $exception->getMessage();

		switch ($this->loglevel) {
			case 0: break;
			case 1: 
				$file = fopen($this->logfile, 'a+');
				fputs($file, "[ERROR] ".$msg."\n");
				fclose($file);
			break;

			case 2: 
				$file = fopen($this->logfile, 'a+');
				fputs($file, "[ERROR] ".$msg."\n");
				fclose($file);
				$this->errors .= sprintf("[ERROR] %s\n",$msg);
				$this->errorCount++;
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