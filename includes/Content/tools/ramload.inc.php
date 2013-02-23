<?php
/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.0.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Gabriel Wanzek
 * @version 1.0
 *
 */


/**
* Sucht nach dem übergebenen String in einem Wert eines eindimensionalem Arrays und gibt den Key zurück.
* Ähnlich "array_search()", jedoch benötigt diese als needle den vollständigen String, und nicht nur einen Teil.
* @param (array)    $array  | Array in dem gesucht werden soll
* @param (string)   $needle | Suchbegriff (Achtung: case sensitive!)
* @return (int)     Fund -> Key
* @return (NULL)    kein Fund
*/

function searchArrayValues ($array, $needle) {
    foreach ($array as $key => $value) {
        if(preg_match('/'.$needle.'/',$value)) {
            return $key;
        }
    }
}

$ram = $server->execute(" dmidecode --type 17");    //gibt HW-Daten über RAM zurück    
$meminfo = $server->execute("cat /proc/meminfo");   //für RAM-Info
$total = explode("\n", $meminfo);                   //Lädt Meminfo Zeilenweise in Array
$error = '';
$search = ['MemTotal:','MemFree:','SwapTotal:','SwapFree:', 'kB'];
$replace = [" "," "," "," "," "];

$trkey = searchArrayValues($total, "MemTotal:");                    //sucht im Array mit dem Suchbegriff und gibt Key zurück
if (isset($total[$trkey])) {
    $totalram = str_replace($search, $replace , $total[$trkey]);    //entfernt Text und gibt Zahl
    $xtotalram = $totalram / 1024;                                  //Umrechnung in MB
} else {
    $xtotalram = 0;
}

$frkey = searchArrayValues($total, "MemFree:");
if (isset($total[$frkey])) {
    $freeram = str_replace($search, $replace , $total[$frkey]);
    $xfreeram = $freeram / 1024;   
} else {
    $xfreeram = 0;
}

$xusedram = $xtotalram - $xfreeram;    //berechne belegten RAM

$stkey = searchArrayValues($total, "SwapTotal:");
if (isset($total[$stkey])) {
    $swaptotal = str_replace($search, $replace , $total[$stkey]);
    $xswaptotal = $swaptotal / 1024;
} else {
    $xswaptotal = 0;
}

$sfkey = searchArrayValues($total, "SwapFree:");
if (isset($total[$sfkey])) {
    $swapfree   = str_replace($search, $replace , $total[$sfkey]);
    $xswapfree = $swapfree / 1024;
} else {
    $xswapfree = 0;
}
$xswapused = $xswaptotal - $xswapfree;   //berechne belegten SWAP-Speicher


if ((!isset($total[$trkey])) || (!isset($total[$frkey]))) {
    $error .= "<span class='error'>Ein Fehler ist aufgetreten. Die RAM-Daten konnten nicht erfolgreich ausgelesen werden.</span>";
} if ((!isset($total[$stkey])) || (!isset($total[$sfkey]))) {
    $error .= "<span class='error'>Ein Fehler ist aufgetreten. Die SWAP-Speicher-Daten konnten nicht erfolgreich ausgelesen werden.</span>";
}

?>

<h3>Arbeitsspeicher Informationen</h3>
<?php if (isset($error)) {echo $error;}?>
<fieldset>
    <div class="halbe-box">
        <h4>RAM</h4>
        <table>
            <tr>
                <td>Total:</td>
                <td><?php echo round($xtotalram, 2) ?> MB</td>
            </tr>
            <tr>
                <td>Frei:</td>
                <td><?php echo round($xfreeram, 2) ?> MB</td>
            </tr>
            <tr>
                <td>Belegt:</td>
                <td><?php echo round($xusedram, 2) ?> MB</td>
            </tr>	
        </table>
        <br>
        <meter style="width:250px; height:25px" min="0" max="<?php echo round($xtotalram, 0) ?>" value="<?php echo round($xusedram, 0) ?>"></meter>
    </div>
    <div class="halbe-box lastbox">
        <h4>Swap</h4>
        <table>
            <tr>
                <td>Total:</td>
                <td><?php echo round($xswaptotal, 2) ?> MB</td>
            </tr>
            <tr>
                <td>Frei:</td>
                <td><?php echo round($xswapfree, 2) ?> MB</td>
            </tr>
            <tr>
                <td>Belegt:</td>
                <td><?php echo round($xswapused, 2) ?> MB</td>
            </tr>
        </table>
        <br>
        <meter style="width:250px; height:25px" min="0" max="<?php echo round($xswaptotal, 0) ?>" value="<?php echo round($xswapused, 0) ?>"></meter>
    </div>
    <div class="clearfix"></div>
    <hr>
    <span class="show_hide">Weitere RAM-Informationen</span>
    <br>
    <div class="spoiler_div console"> 
        <pre class="simple"><?php echo $ram ?></pre>
    </div>
</fieldset>
