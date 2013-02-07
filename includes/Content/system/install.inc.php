<h3>Paket Installation</h3>
<form action="index.php?p=system&s=install" method="POST">
    <fieldset>  
        <legend>Paketsuche</legend>	
        <div class="halbe-box">
            <input type="text" class="text-long" name="aptcache">
            <br><br><br>
            <input type="submit" class="button green" name="search" value="suchen">
            <br>
        </div>
        <div class="halbe-box lastbox">
            Gefundene Pakete:
        </div>
    </fieldset>
    <fieldset>
        <legend>Installation</legend>
        <label>Paketname:</label>
        <input type="text" class="text-long" name="aptgetinstall">
        <br><br><br>
        <input type="submit" class="button green" name="install" value="installieren">
    </fieldset>
</from>

