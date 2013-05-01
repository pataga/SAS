<?php
/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.0.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Tanja Weiser
 *
 */

$log1 = $server->execute('cat /var/log/proftpd/proftpd.log');
$log2 = $server->execute('cat /var/log/proftpd/xferlog');

?>

<br><br>
	<fieldset>
		<legend>proftpd.log</legend>
		<textarea id="console">
        	<?=$log1?>
        </textarea>
      		<br>
	</fieldset>
	
	<fieldset>
		<legend>xferlog</legend>
		<textarea id="console">
        	<?=$log2?>
        </textarea>
      		<br>
	</fieldset>
	
	<fieldset>
        <legend>Informationen</legend>
        Informationen zu <a href="http://www.castaglia.org/proftpd/doc/xferlog.html" target="_blank">xferlog</a>
    </fieldset>