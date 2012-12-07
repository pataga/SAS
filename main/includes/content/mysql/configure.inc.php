<?php


    /**
    * Licensed under The Apache License
    *
    * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
    * @link https://github.com/pataga/SAS
    * @since SAS v1.0.0
    * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
    * @author Patrick Farnkopf
    *
    */

    
    if ($server->isInstalled('mysql'))
    {
        header('Location: ?p=mysql');
        die();
    }
    if (isset($_POST['submission']))
    {
        $database->addMySQL($_POST['mhost'],$_POST['muser'],$_POST['mpass']);
        $loader->reload();
    }
?>
<h2>MySQL einrichten</h2>
<form action="?p=mysql&s=configure" method="post">
     <table>
         <tr>
             <td>MySQL-Host</td>
             <td><input type="text" name="mhost"</td>
         </tr>
         <tr>
             <td>MySQL-Port</td>
             <td><input type="text" name="mport"</td>
         </tr>
         <tr>
             <td>MySQL-Benutzer</td>
             <td><input type="text" name="muser"</td>
         </tr>
         <tr>
             <td>MySQL-Passwort</td>
             <td><input type="password" name="mpass"</td>
         </tr>
         <tr>
             <td>&nbsp;</td>
             <td><input type="submit" name="submission" value="MySQL einrichten"</td>
         </tr>
     </table>
 </form> 
 