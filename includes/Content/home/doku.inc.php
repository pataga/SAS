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
    document.getElementById('loading').style.display = "none"; 
    document.getElementById('frame').style.display = "block"; 
} 
</script> 
<h3>Dokumentation</h3>
<div class="centered">
<a href="http://goo.gl/dTrur" target="_blank">SAS-Dokumentation (Google Docs)</a> &middot; <a href="http://mangopix.de/pataga/doku.pdf">PDF - Download</a>
</div>
<div id="loading"> 
	<img src="img/load.gif" id="img" alt="Loading...">
	<p id="text" style="display:none;">Das Dokument lädt ungewöhnlich lange...</p>
	<script>
		$('#text').delay(5000).fadeIn('slow');
	</script>
</div> 
<div id="frame" style="display:none"> 
<iframe style="box-shadow: 0 0 5px #ccc;" width="765" height="600" frameborder="0" src="https://docs.google.com/document/d/1tT_4tVx39EPtJBGTiyu5Nfnd7kbjpz4-z4-gJd8GTtY/pub?embedded=true" onload="showiframe()"></iframe>
</div>