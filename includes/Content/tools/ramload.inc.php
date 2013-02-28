<?php
/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.0.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Gabriel Wanzek
 * @version 1.3
 *
 */
require_once('./includes/Content/main/module_functions.inc.php');

$ram = $server->execute(" dmidecode --type 17");            //gibt HW-Daten über RAM zurück    
$memory = $server->execute("free | head -3 | tail -2");     //für RAM-Info
$swap = $server->execute("free | grep Swap");               //für Swap-Info
?>

<h3>Arbeitsspeicher Informationen</h3>
<fieldset>
    <div class="halbe-box">
        <h4>RAM</h4>
        <table>
            <tr>
                <td>Total:</td>
                <td><?php echo getMemoryData($memory, 0); ?> MB</td>
            </tr>
            <tr>
                <td>Frei:</td>
                <td><?php echo getMemoryData($memory, 2); ?> MB</td>
            </tr>
            <tr>
                <td>Belegt:</td>
                <td><?php echo getMemoryData($memory, 1); ?> MB</td>
            </tr>	
        </table>
        <br>
        <meter style="width:250px; height:25px" min="0" high="<?php echo getMemoryData($memory, 0)*0.9; ?>" max="<?php echo getMemoryData($memory, 0); ?>" value="<?php echo getMemoryData($memory, 1); ?>"></meter>
    </div>
    <div class="halbe-box lastbox">
        <h4>Swap</h4>
        <table>
            <tr>
                <td>Total:</td>
                <td><?php echo getSwapData($swap, 0); ?> MB</td>
            </tr>
            <tr>
                <td>Frei:</td>
                <td><?php echo getSwapData($swap, 2); ?> MB</td>
            </tr>
            <tr>
                <td>Belegt:</td>
                <td><?php echo getSwapData($swap, 1); ?> MB</td>
            </tr>
        </table>
        <br>
        <meter style="width:250px; height:25px" min="0" high="<?php echo getSwapData($swap, 0)*0.9; ?>" max="<?php echo getSwapData($swap, 0); ?>" value="<?php echo getSwapData($swap, 1); ?>"></meter>
    </div>
    <div class="clearfix"></div>
    <hr>
    <span class="show_hide">Weitere RAM-Informationen</span>
    <br>
    <div class="spoiler_div console"> 
        <pre class="simple"><?php echo $ram ?></pre>
    </div>
</fieldset>
