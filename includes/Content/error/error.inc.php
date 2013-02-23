<!DOCTYPE html>
<html>
	<head>
		<title>Ooops!</title>
		<link rel="stylesheet" type="text/css" href="css/oops.css" media="all">
		<meta charset="UTF-8">
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
            <a href="https://github.com/PatrickFarnkopf" target="_blank">Patrick Farnkopf</a> 
            <a href="https://github.com/TanjaWeiser" target="_blank">Tanja Weiser</a> 
            <a class="last" href="https://github.com/GabrielWanzek" target="_blank">Gabriel Wanzek</a>
		</p>
	</footer>
</html>
