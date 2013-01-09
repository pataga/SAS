<?php
$ssh->openConnection();

$en_mods_a2 = $ssh->execute("ls -1 /etc/apache2/mods-enabled/ | grep load", 2);
$av_mods_a2 = $ssh->execute("ls -1 /etc/apache2/mods-available/ | grep load", 2);

if (isset($_POST['akt'])) {
	$ssh->execute("a2enmod ".$_POST['akt']."&& service apache2 restart");
}

if (isset($_POST['deakt'])) {
	$ssh->execute("a2dismod ".$_POST['deakt']." && service apache2 restart");
}
?>
<h3>Module</h3>
<?php
if (isset($_POST['akt'])) 
    echo '<span class="success"><b>Info:</b><br>Das Modul '.$_POST['akt'].' wurde aktiviert.</span>';
if (isset($_POST['deakt'])) 
    echo '<span class="success"><b>Info:</b><br>Das Modul '.$_POST['deakt'].' wurde deaktiviert.</span>';
?>
<div class="halbe-box">
	<fieldset>
		<legend>Verfügbare Module</legend>
        <div name="a2_module" class="a2_module_big"><?php
        foreach ($av_mods_a2 as $key => $value) {
	        echo str_replace(".load", "<br>", $value);
        }
        ?><br></div>

	</fieldset>
</div>
<div class="halbe-box lastbox">
	<fieldset>
		<legend>Aktive Module</legend>
        <div name="a2_module" class="a2_module_big"><?php foreach ($en_mods_a2 as $key => $value) {
                echo  str_replace(".load", "<br>", $value);
        };?><br></div>


	</fieldset>
</div>
<div class="clearfix"></div>

<div class="halbe-box">
	<fieldset>
		<legend>Modul aktivieren</legend>
        <form action="?p=apache&s=module" method="post">
		<input class="text-medium" name="akt" type="text" list="avmods" required>
		<datalist id="avmods">
		   	<?php 
		        foreach ($av_mods_a2 as $key => $value) {
			        echo "\t\t\t".'<option value="'.str_replace(".load", '">', $value);//.'">';
		        }
		   	?>
		</datalist> 
		<input type="submit" value="aktivieren" class="button black">
        </form>
	</fieldset>
</div>
<div class="halbe-box lastbox">
	<fieldset>
		<legend>Modul deaktivieren</legend>
        <form action="?p=apache&s=module" method="post">
		<input class="text-medium" name="deakt" type="text" list="enmods" required>
		<datalist id="enmods">
		   	<?php 
		        foreach ($en_mods_a2 as $key => $value) {
			        echo "\t\t\t".'<option value="'.str_replace(".load", '">', $value);//.'">';
		        }
		   	?>
		</datalist> 
		<input type="submit" value="deaktivieren" class="button black">
        </form>
	</fieldset>
</div>
<div class="clearfix"></div>
<fieldset>
	<legend>Informationen</legend>
	<a href="http://httpd.apache.org/docs/2.2/mod/index.html" target="_blank">Hier</a> finden Sie Informationen zu sämtlichen Modulen.
</fieldset>