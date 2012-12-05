<?php

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
		return $this->ssh->execute('ps axw', 2);
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
				if(!empty($currentAttr))
					$attr[] = $currentAttr; 
			}
			
			$data[$i][0] = $attr[0];
			$data[$i][1] = $attr[1];
			$data[$i][2] = $attr[2];
			$data[$i][3] = $attr[3];
			$data[$i][4] = $attr[4];
			$i++;
		}
		return $data;
	}

}

?>