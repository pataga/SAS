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


namespace Module\Process;

class Process {

	private $ssh;

	function __construct($main) {
		$this->ssh = $main->getSSHInstance();
		$this->ssh->openConnection();
	}

   /**
    * Holt die aktuelle Liste der Serverprozesse und gibt sie zurück
    * @return (array) Prozesse
    */	
	private function getProcesses() {
		return $this->ssh->execute('ps auxw', 2);
	}

   /**
	* Teilt die Prozesse in ihre Attribute auf und gibt einen zweidimensionalen Array zurück
	* @return (array(array)) Prozess Attribute 
	*/
	public function getProcessArray() {
		$proc = $this->getProcesses();
		$i = 0;
		$data = array(array());
		foreach ($proc as $value) {
			$attrW = explode(" ", $value);

			$attr = array();
			foreach($attrW as $currentAttr) {
				$currentAttr = trim($currentAttr);

				if(!empty($currentAttr) || $currentAttr === '0')
					$attr[] = $currentAttr; 
			}
			
			$data[$i][] = $attr[0];  //USER
			$data[$i][] = $attr[1];  //PID
			$data[$i][] = $attr[2];  //CPU
			$data[$i][] = $attr[3];  //MEM
			$data[$i][] = $attr[4];  //VSZ
			$data[$i][] = $attr[5];  //RSS
			$data[$i][] = $attr[6];  //TTY
			$data[$i][] = $attr[7];  //STAT
			$data[$i][] = $attr[8];  //START
			$data[$i][] = $attr[9];  //TIME
			$data[$i][] = $attr[10]; //COMMAND
			$i++;
		}
		return $data;
	}

}

?>