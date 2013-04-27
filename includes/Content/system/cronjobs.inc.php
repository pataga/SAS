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

$param = $_POST;
if (isset($param['create'])) {
    $cronLine = '';

    if ($param['min'] == 1) {
        $cronLine .= '* ';
    } else {
        $cronLine .= implode(',', $param['minval']).'  ';
    }

    if ($param['std'] == 1) {
        $cronLine .= '* ';
    } else {
        $cronLine .= implode(',', $param['stdval']).'  ';
    }

    if ($param['day'] == 1) {
        $cronLine .= '* ';
    } else {
        $cronLine .= implode(',', $param['dayval']).'  ';
    }

    if ($param['month'] == 1) {
        $cronLine .= '* ';
    } else {
        $cronLine .= implode(',', $param['monval']).'  ';
    }

    if ($param['wday'] == 1) {
        $cronLine .= '* ';
    } else {
        $cronLine .= implode(',', $param['wdayval']).'  ';
    }

    $cronLine .= ' root '.$param['cmd'];
    $server->execute('echo "'.$cronLine.'" >> /etc/crontab');
}

?>

<h3>Cronjobs</h3>
<fieldset>
    <form action="?p=system&s=cronjobs" method="post">
        <span style="font-size: 16px; font-weight: bold; margin-right: 20px;">Kommando</span> <input type="text" name="cmd" class="text-long-ext" required="required"/><br><hr><br>
        <div class="fuenftel-box">
            <input type="radio" name="min" value="1" checked="checked" onchange="document.getElementById('min').setAttribute('disabled', 'disabled');"/> Jede Minute<br>
            <input type="radio" name="min" value="2" onchange="document.getElementById('min').removeAttribute('disabled');"/> Minuten w&auml;hlen<br>
            <select name="minval[]" multiple style="height:160px;" id="min" disabled="disabled">
                <?php
                for ($i=0; $i<60; $i++) {
                ?>
                <option value="<?=$i?>"><?=$i?></option>
                <?php
                }
                ?>
            </select>
        </div>

        <div class="fuenftel-box">
            <input type="radio" name="std" value="1" checked="checked" onchange="document.getElementById('std').setAttribute('disabled', 'disabled');"/> Jede Stunde<br>
            <input type="radio" name="std" value="2" onchange="document.getElementById('std').removeAttribute('disabled');"/> Stunden w&auml;hlen<br>
            <select name="stdval[]" multiple style="height:160px;" id="std" disabled="disabled">
                <?php
                for ($i=0; $i<24; $i++) {
                    ?>
                    <option value="<?=$i?>"><?=$i?></option>
                <?php
                }
                ?>
            </select>
        </div>

        <div class="fuenftel-box">
            <input type="radio" name="day" value="1" checked="checked" onchange="document.getElementById('day').setAttribute('disabled', 'disabled');"/> Jeden Tag<br>
            <input type="radio" name="day" value="2" onchange="document.getElementById('day').removeAttribute('disabled');"/> Tag w&auml;hlen<br>
            <select name="dayval[]" multiple style="height:160px;" id="day" disabled="disabled">
                <?php
                for ($i=1; $i<31; $i++) {
                    ?>
                    <option value="<?=$i?>"><?=$i?></option>
                <?php
                }
                ?>
            </select>
        </div>

        <div class="fuenftel-box">
            <input type="radio" name="month" value="1" checked="checked" onchange="document.getElementById('month').setAttribute('disabled', 'disabled');"/> Jeden Monat<br>
            <input type="radio" name="month" value="2" onchange="document.getElementById('month').removeAttribute('disabled');"/> Monat w&auml;hlen<br>
            <select name="monval[]" multiple style="height:160px;" id="month" disabled="disabled">
                <option value="1">Januar</option>
                <option value="2">Februar</option>
                <option value="3">M&auml;rz</option>
                <option value="4">April</option>
                <option value="5">Mai</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Dezember</option>
            </select>
        </div>

        <div class="fuenftel-box lastbox">
            <input type="radio" name="wday" value="1" checked="checked" onchange="document.getElementById('wday').setAttribute('disabled', 'disabled');"/> Jeden Wochentag<br>
            <input type="radio" name="wday" value="2" onchange="document.getElementById('wday').removeAttribute('disabled');"/> Wochentag w&auml;hlen<br>
            <select id="wday" name="wdayval[]" multiple style="height:160px;" disabled="disabled">
                <option value="1">Montag</option>
                <option value="2">Dienstag</option>
                <option value="3">Mittwoch</option>
                <option value="4">Donnerstag</option>
                <option value="5">Freitag</option>
                <option value="6">Samstag</option>
                <option value="7">Sonntag</option>
            </select>
        </div>
        <div class="clearfix"></div>
        <br><hr><br>
        <input type="submit" value="Cronjob erstellen" name="create" class="button black" style="margin-right:15px;"/>
        <input type="reset" value="Einstellungen zur&uuml;cksetzen" class="button black" onclick="resetCronForm();"/>
    </form>
</fieldset>


