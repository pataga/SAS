<h3> Hier ensteht die Seite "MySQL"</h3>
<fieldset>
	<table>
		<?php
			require_once("includes/classes/class.server.php");
			$server = new Server();
			// Serverdaten vorerst statisch, bis Auswahlseite erstellt wurde
			$server->setServerHost("127.0.0.1");
			$server->setServerUser("root");
			$server->setServerPass("12345");
			$server->setServerID();
			print_r($server->getMySQLDatabases());
		?>
	</table>
</fieldset>
