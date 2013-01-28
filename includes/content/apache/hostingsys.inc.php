<?php
$ssh->openConnection();
$phpv = $ssh->execute("php -v",2);
$phpm = $ssh->execute("php -m",2);
$all_groups = $ssh->execute("cat /etc/group | cut -d: -f1 ", 2);

$filter = ['No entry for terminal type "bash";','using dumb terminal settings.'];
$filter2 = ['[',']'];
$replace = ['<b>',':</b>'];

$phpvs = str_replace($filter, NULL, $phpv);
$phpms = str_replace($filter, NULL, $phpm);
$phpmsa = str_replace($filter2, $replace, $phpms);
?>

<h3>PHP</h3>
<fieldset>
    <div class="halbe-box">
        <h5>Version:</h5>
        <table>
            <tr>
                <td><code class="simple"><?php echo $phpvs[2]; ?></code></td>
            </tr>
        </table>
    </div>
    <div class="halbe-box lastbox">PHP-Module:</h5>
        <div class="a2_module"><?php
foreach ($phpmsa as $key => $value) {
    echo $value;
};
?></div>
    </div>
    <div class="clearfix"></div>
</fieldset>
</fieldset>