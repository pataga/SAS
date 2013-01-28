<?php
$ssh->openConnection();
$all_users = $ssh->execute("cat /etc/passwd | cut -d: -f1", 2);
$seq_users = $ssh->execute("awk -F: '$3>999{print $1}' /etc/passwd", 2);
$all_groups = $ssh->execute("cat /etc/group | cut -d: -f1 ", 2);
?>
<h3>User &amp; Gruppen</h3>
<div class="halbe-box">
    <h4>Existierende User</h4>
    <fieldset>
        <h5>User ID &lt; ID 1000</h5>
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
        <div class="clearfix"></div>
        <h5>Alle Gruppen</h5>
        <div class="listbox">
            <?php
            foreach ($all_groups as $key => $value) {
               echo $value . "<br>";
            }
            ?>
        </div>
    </fieldset>
        <fieldset>
        <legend>User einer Gruppe zuweisen</legend>
        <form action="index.php?p=tools&s=cpu" method="post" autocomplete="off">
            <p><label>Benutzername:</label> 
                <input type="text" class="text-long" name="name" required list="users"></p>
            <datalist id="users">
<?php
foreach ($all_users as $key => $value) {
    echo '<option value="' . $value . '">';
}
?>
            </datalist>
            <p><label>Gruppe:</label> 
                <input type="text" class="text-long" name="name" required list="all_groups"></p>
            <datalist id="all_groups">
<?php
foreach ($all_groups as $key => $value) {
    echo '<option value="' . $value . '">';
}
?>
            </datalist>
            <input type="submit" value="zuweisen" name="addg" class="button black">
        </form>
    </fieldset>
</div>
<div class="halbe-box lastbox">
    <h4>Aktionen</h4>
    <fieldset>
        <legend>User anlegen</legend>
        <form action="index.php?p=tools&s=cpu" method="post" autocomplete="off">
            <p><label>Benutzername:</label> 
                <input type="text" class="text-long" name="name" required></p>
            <p><label>Passwort:</label> 
                <input type="text" class="text-long" name="pw" required></p>
            <p><label>Passwort wiederholen:</label> 
                <input type="text" class="text-long" name="pwx" required></p>
            <p><input type="checkbox" name="home" checked> Home-Ordner erstellen?</p>
            <input type="submit" value="anlegen" name="add" class="button black">
        </form>
    </fieldset>
    <fieldset>
        <legend>User entfernen</legend>
        <form action="index.php?p=tools&s=cpu" method="post" autocomplete="off">
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
        <legend>Passwort ändern</legend>
        <form action="index.php?p=tools&s=cpu" name="pw" method="post" autocomplete="off">
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
                <input type="text" class="text-long" name="´pw" required"></p>
            <p><label>Neues Passwort wiederholen:</label> 
                <input type="text" class="text-long" name="pwx" required"></p>
            <input type="submit" value="ändern" name="addg" class="button black">
        </form>
    </fieldset>
</div>
