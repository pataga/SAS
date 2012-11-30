<?php
$ssh->openConnection();
if (isset($_POST['create_file']) && isset($_POST['create_file_s'])) {           //wenn hidden+submit ..
    $ssh->execute("mkdir /var/www/sas_rf/ && touch /var/www/sas_rf/phpinfo.php");
    $ssh->execute("echo '<?php phpinfo(); ?>' > /var/www/sas_rf/phpinfo.php");
}
?>
<h3>phpinfo</h3>
<iframe class="phpinfo" src="http://<?php echo $data[0]; ?>/sas_rf/phpinfo.php" frameborder="0"></iframe>
<br>
<p style="margin-top:15px;">Falls die Datei nicht gefunden wird können Sie diese hier generieren:<br></p>
<form action="<?php $_SERVER['SCRIPT_NAME'] ?>" method="post">
    <input type="hidden" name="create_file">
    <input type="submit" value="phpinfo generieren" name="create_file_s" class="button darkblue">
</form>
<?php
if (isset($_POST['create_file']) && isset($_POST['create_file_s'])) {
    echo '<hr>
<span class="success"><b>Hinweis:</b><br>Die Datei wurde unter folgendendem Pfad generiert:&nbsp;
    <code class="simple">
        <a href="http://'.$data[0].'/sas_rf/phpinfo.php">/var/www/sas_rf/phpinfo.php</a>
    </code>
</span>
';
}
?>