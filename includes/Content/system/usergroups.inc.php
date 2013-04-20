<?php
/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.0.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Gabriel Wanzek
 * echo -ne "'.$_POST['pw'].'\n'.$_POST['pw'].'\n" | adduser '.$_POST['name'].' --no-create-home
 */

if (isset($_POST['add'])) {
    echo $server->execute("useradd ".$_POST['name']);
}

if (isset($_POST['del'])) {
    echo $server->execute("deluser ".$_POST['name']);
}

$all_users = $server->execute("cat /etc/passwd | cut -d: -f1", 2);
$seq_users = $server->execute("awk -F: '$3>999{print $1}' /etc/passwd", 2);
$all_groups = $server->execute("cat /etc/group | cut -d: -f1 ", 2);

if (isset($_POST['addg'])) {
    echo $server->execute("useradd -G ".$_POST['g']." ".$_POST['u']);
}

if (isset($_POST['pwc'])) {
    echo $server->execute('echo -ne "'.$_POST['pw'].'\n'.$_POST['pw'].'\n" | passwd '.$_POST['name']);
}

?>
<h3>User &amp; Gruppen</h3>
<div class="halbe-box">
    <fieldset>
        <legend>Bestehende User</legend>
        <h5>User ID &gt; ID 1000</h5>
        <div class="listbox">
            <?php
            foreach ($seq_users as $key => $value) {
                echo $value . "<br>";
            }
            ?>
            <br>
        </div>
        <div class="clearfix"></div>
        <h5>Alle User</h5>
        <div class="listbox">
            <?php
            foreach ($all_users as $key => $value) {
                echo $value . "<br>";
            }
            ?>
        </div>
    </fieldset>
    <fieldset>
        <legend>Gruppen</legend>
        <div class="listbox">
            <?php
            foreach ($all_groups as $key => $value) {
               echo $value . "<br>";
            }
            ?>
        </div>
    </fieldset>
</div>
<div class="halbe-box lastbox">
    <fieldset>
        <legend>User anlegen</legend>
        <form action="?p=system&s=usergroups" method="post" autocomplete="off">
            <p><label>Benutzername:</label> 
                <input type="text" class="text-long" name="name" required></p>
            <input type="submit" value="anlegen" name="add" class="button black">
        </form>
    </fieldset>
    <fieldset>
        <legend>User entfernen</legend>
        <form action="?p=system&s=usergroups" method="post" autocomplete="off">
            <p><label>Benutzername:</label> 
                <input type="text" class="text-long" name="name" required list="users"></p>
            <datalist id="users">
<?php
foreach ($all_users as $key => $value) {
    echo '<option value="' . $value . '">';
}
?>
            </datalist>
            <input type="submit" value="löschen" name="del" class="button pink">
        </form>
    </fieldset>
    <fieldset>
        <legend>Passwort zuweisen/ändern</legend>
        <form action="?p=system&s=usergroups" method="post" autocomplete="off">
            <p><label>Benutzername:</label> 
                <input type="text" class="text-long" name="name" required list="users"></p>
            <datalist id="users">
<?php
foreach ($all_users as $key => $value) {
    echo '<option value="' . $value . '">';
}
?>
            </datalist>
            <p><label>Neues Passwort:</label> 
                <input type="text" class="text-long" name="pw" required></p>
            <input type="submit" value="ändern" name="pwc" class="button black">
        </form>
    </fieldset>
    
<?php // verursacht noch Fehler ?>
    <!--<fieldset>
        <legend>User einer Gruppe zuweisen</legend>
        <form action="?p=system&s=usergroups" method="post" autocomplete="off">
            <p><label>Benutzername:</label> 
                <input type="text" class="text-long" name="u" required list="users"></p>
            <datalist id="users">
<?php
foreach ($all_users as $key => $value) {
    echo '<option value="' . $value . '">';
}
?>
            </datalist>
            <p><label>Gruppe:</label> 
                <input type="text" class="text-long" name="g" required list="all_groups"></p>
            <datalist id="all_groups">
<?php
foreach ($all_groups as $key => $value) {
    echo '<option value="' . $value . '">';
}
?>
            </datalist>
            <input type="submit" value="zuweisen" name="addg" class="button black">
        </form>
    </fieldset>-->
</div>
