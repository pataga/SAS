<?php
/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.0.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
 * @author Gabriel Wanzek
 *
 */
?>
<h3>SAS-Repository</h3>
<img src="img/github.png" alt="GitHub Logo" style="float:right;">
<p>Sie werden in <span id="sec_time">5</span> Sekunden auf eine externe Seite weitergeleitet, sollte die Weiterleitung nicht erfolgen, klicken Sie bitte <a href="https://github.com/pataga/SAS/">hier</a>.</p>
<script>
	var sec = 5;
	var url = "https://github.com/pataga/SAS/";
	var SetInt = window.setInterval("umleitung()", 1000);

		function umleitung(){
			sec--;
			document.getElementById('sec_time').innerHTML=sec;
			if(sec==0){
				window.clearInterval(SetInt);
				window.location = url;
			}
		}
</script>