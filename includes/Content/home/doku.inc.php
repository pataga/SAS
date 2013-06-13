<?php
/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.0.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Gabriel Wanzek
 * @version 1.1
 *
 */
?>
<style type="text/css">#loading p {text-align: center;}#loading img {padding-top:100px;padding-bottom:100px;display: block;margin-left: auto;margin-right: auto;}.centered {text-align: center;vertical-align: middle;padding-bottom: 5px;}</style>
<script type="text/javascript">
function showiframe() {    
	$('#loading').slideUp(200);
	$('#frame').fadeIn('slow');
} 
</script> 
<h3>Dokumentation</h3>
<div class="centered">
<a href="https://docs.google.com/file/d/0Bww1bWeFV4q_RWZjcVN4QXJyY1k" target="_blank">SAS-Dokumentation (Google Docs)</a> &middot; <a href="http://mangopix.de/pataga/doku.pdf">PDF - Download</a>
</div>
<div id="loading"> 
	<img src="img/load.gif" id="img" alt="Loading...">
	<p id="text" style="display:none;">Das Dokument lädt ungewöhnlich lange...</p>
	<script>
		$('#text').delay(5000).fadeIn('slow');
	</script>
</div> 
<div id="frame" style="display:none">
<iframe style="box-shadow: 0 0 5px #ccc;" width="765" height="600" frameborder="0" src="https://docs.google.com/document/d/1hukXg3i2yNqPLXS_kya2b27Ar80m0gASJYqIWnHl9Us/pub?embedded=true" onload="showiframe()"></iframe>
</div>
