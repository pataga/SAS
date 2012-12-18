<?php


/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
* @author Tanja Weiser
*
*/



$result = $mysql->Query("SELECT * FROM sas_users");
$content = "<table>";
while ($row = $result->fetchObject()) {
    $content .= "<tr><td>".$row->username."</td>";
    $content .= "<td>".$row->email."</td>";
    $content .= "<td><form action='?p=webuser&s=edit' method='post'><input type='submit' name='edit' value='bearbeiten'>
                        <input type='hidden' name='id' value='".$row->id."'></form></td></tr>";
}
$content .= "</table>";

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $result = $mysql->Query("SELECT * FROM sas_users WHERE id = ".$id);
    $row = $result->fetchObject();

    echo '

<form action="index.php?p=webuser&s=edit" method="post">
    Username:<input type="text" name="user" value="'.$row->username.'"><br>
    E-Mail:<input type="text" name="mail" value="'.$row->email.'"><br>
    Passwort:<input type="password" name="pw" id=""><br>
    Passwort wiederholen:<input type="password" name="pwr" id=""><br>
    <input type="submit" name="absenden" value="absenden"><br>
    <input type="hidden" name="id" value="'.$id.'">
</form>
';
}

if (isset($_POST['absenden'])) {

    if(isset($_POST['pw']) && isset($_POST['pwr']) && $_POST['pw'] == $_POST['pwr']){

        $user=$_POST['user'];
        $email=$_POST['mail'];
        $pw=md5($_POST['pw']);

        $mysql->Query("UPDATE sas_users SET username = '$user', password = '$pw', email ='$email' WHERE id = ".$_POST['id']);
    }
    //Überprüfen ob Passwort gesetzt
    //$mysql->Query("UPDATE sas_users SET ... = ... WHERE id = ".$_POST['id']);
}


if (isset($_POST['edituser']))
{
    $username = $_POST['username'];
}

?>




<!--############ User bearbeiten ############//-->
<h3>Benutzer bearbeiten</h3>
<fieldset>
    <?=$content?>
<form action="index.php?p=webuser&s=edit" method="POST">   
</form>
</fieldset>
