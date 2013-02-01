<?php
$ram = $server->execute(" dmidecode --type 17");
$meminfo = $server->execute("cat /proc/meminfo");        //für RAM-Info
$total = explode("\n", $meminfo);
$totalram = str_replace("MemTotal:", " ", $total[0]);
$totalram_ = str_replace("kB", " ", $totalram);
$totalram_a = $totalram / 1024;     //Umrechnung in MB

$free = explode("\n", $meminfo);
$freeram = str_replace("MemFree:", " ", $total[1]);
$freeram_ = str_replace("kB", " ", $freeram);
$freeram_a = $freeram / 1024;
$usedram = $totalram_a - $freeram_a;

$swaptotal_ = str_replace("SwapTotal:", " ", $total[13]);
$swaptotal_a = str_replace("kB", "", $swaptotal_);
$swaptotal_b = $swaptotal_a / 1024;

$swapfree_ = str_replace("SwapFree:", " ", $total[14]);
$swapfree_a = str_replace("kB", "", $swapfree_);
$swapfree_b = $swapfree_a / 1024;

$swapused = $swaptotal_b - $swapfree_b;
?>

<h3>Arbeitsspeicher Informationen</h3>
<fieldset>
    <div class="halbe-box">
        <h4>RAM</h4>
        <table>
            <tr>
                <td>Total:</td>
                <td><?php echo round($totalram_a, 2) ?> MB</td>
            </tr>
            <tr>
                <td>Frei:</td>
                <td><?php echo round($freeram_a, 2) ?> MB</td>
            </tr>
            <tr>
                <td>Belegt:</td>
                <td><?php echo round($usedram, 2) ?> MB</td>
            </tr>	
        </table>
        <br>
        <meter style="width:250px; height:25px" min="0" max="<?php echo round($totalram_a, 0) ?>" value="<?php echo round($usedram, 0) ?>"></meter>
    </div>
    <div class="halbe-box lastbox">
        <h4>Swap</h4>
        <table>
            <tr>
                <td>Total:</td>
                <td><?php echo round($swaptotal_b, 2) ?> MB</td>
            </tr>
            <tr>
                <td>Frei:</td>
                <td><?php echo round($swapfree_b, 2) ?> MB</td>
            </tr>
            <tr>
                <td>Belegt:</td>
                <td><?php echo round($swapused, 2) ?> MB</td>
            </tr>
        </table>
        <br>
        <meter style="width:250px; height:25px" min="0" max="<?php echo round($swaptotal_b, 0) ?>" value="<?php echo round($swapused, 0) ?>"></meter>
    </div>
    <div class="clearfix"></div>
    <hr>
    <span class="show_hide">Weitere RAM-Informationen</span>
    <br>
    <div class="spoiler_div console"> 
        <pre class="simple"><?php echo $ram ?></pre>
    </div>
</fieldset>
