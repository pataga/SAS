<?php

class Debug {

	public function __construct($loglevel=1, $logfile='error.log') {
		$this->loglevel = $loglevel;
		$this->logfile = $logfile;
	}

	public function error($exception) {
		$msg = $exception->getMessage();

		switch ($this->loglevel) {
			case 0: break;
			case 1: 
				$file = fopen($this->logfile, 'a+');
				fputs($file, "[ERROR] ".$msg);
				fclose($file);
			break;

			case 2: 
				$file = fopen($this->logfile, 'a+');
				fputs($file, "[ERROR] ".$msg);
				fclose($file);
				throw new Exception("Ein schwerwiegender Fehler ist aufgetreten! :D");
			break;
		}
	}
}

?>