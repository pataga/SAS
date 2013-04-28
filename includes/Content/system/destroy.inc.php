<?php

/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.1.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Patrick Farnkopf
 *
 */

if (isset($_POST['destruction'])) {
    //Selbstzerstörung initialisieren
}
?>
<h3>Selbstzerstörung</h3>
<fieldset style="text-align: center;">
	<h5>Diese Funktion wird das komplette System Ihres Server zerst&ouml;ren.<br>Gebrauchen sie diese Funktion mit h&ouml;chster Sorgfalt!</h5>
    <form action="?p=system&s=destroy" method="post" id="selfDestruction">
        <input type="button" value="Selbstzerst&ouml;rung" class="button pink" style="padding:60px 80px;font-size:2.5em;" onclick="selfDestruction();"/>
        <input type="hidden" name="destruction"/>
    </form>
</fieldset>

