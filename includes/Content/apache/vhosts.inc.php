<h3>Virtuelle Hosts</h3>
<div class="halbe-box">
	<fieldset>
		<legend>vHost erstellen</legend>
		<form action="index.php?p=apache&s=vhosts" method="post">
			<i>Felder mit * müssen ausgefüllt werden.</i><br><br>
		<p>
			Adresse*:<br>
			<input class="text-long" type="text" name="addr" id="addr" required placeholder="IP oder Hostname">
		</p>
		<p>
			ServerName*:<br>
			<input class="text-long" type="text" name="sn" id="sn" required placeholder="Name des vHosts">
		</p>
		<p>
			ServerAdmin*:<br>
			<input class="text-long" type="email" name="sad" id="sad" required placeholder="email_des_admins@example.org">
		</p>
		<p>
			DocumentRoot*:<br>
			<input class="text-long" type="text" name="dr" id="dr" required placeholder="Basisverzeichnis des vHosts">
		</p>
		<p>
			ErrorLog:<br>
			<input class="text-long" type="text" name="el" id="el" placeholder="Fehler-Log des vHosts">
		</p>
		<p>
			TransferLog:<br>
			<input class="text-long" type="text" name="tl" id="tl" placeholder="Transfer-Log des vHosts">
		</p>
		<p>
			<input type="submit" value="Erstellen" class="button black">
		</p>
		</form>
	</fieldset>
</div>
<div class="halbe-box lastbox">
	<fieldset>
		<legend>vHost bearbeiten</legend>
		<i>keine vHosts vorhanden.</i>
	</fieldset>
</div>
<div class="clearfix"></div>
