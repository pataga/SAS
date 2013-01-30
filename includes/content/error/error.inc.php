<html>
	<head>
		<title>Ooops!</title>
		<link rel="stylesheet" type="text/css" href="css/oops.css" media="all">
	</head>
	<style>
	
	</style>
	<body class="fade-in">
	<header>
		<h1>Ooops!</h1>
		<h3>Ein Fehler ist aufgetreten!</h3>
	</header>	
<pre>
<?php
if (isset($debug)) echo $debug->getError();
?>
</pre>
	</body>
	<footer>
		<p>
			 <a class="last" target="_blank" href="https://github.com/pataga/">&copy; <?php echo date('Y')?> SAS - Server Admin System [v1.1]</a>
            <br><br> 
            <a onclick="alert(unescape('Diese Seite ist vor%FCbergehend nicht erreichbar.'))" href="#">Patrick Farnkopf</a> <a onclick="alert(unescape('Diese Seite ist vor%FCbergehend nicht erreichbar.'))" href="#">Tanja Weiser</a><a class="last" href="http://mangopix.de" target="_blank">Gabriel Wanzek</a>
		</p>
	</footer>
</html>
