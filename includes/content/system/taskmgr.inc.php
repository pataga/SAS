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

?>

<?php
$proc = new \Module\Tools\Process($main);

if (isset($_POST['kill'])) {
    for ($i=0;$i<6000;$i++) {
        if (isset($_POST["pid_".$i])) {
            $pid = $_POST["pid_".$i];
            echo $pid."<br>";
            $ssh->execute("kill ".$pid);
        }
    }
}

?>

<h3>Taskmanager<sup>ALPHA</sup></h3>
<fieldset>
    <form action="index.php?p=system&s=taskmgr" method="post">
        <table>
            <tr>
                <td> 
                    <input type="submit" value="Prozess beenden" name="kill">
                    <input type="submit" value="H&ouml;here Priorit&auml;t" name="nice"> 
                </td>
            </tr>
        </table>
    	<table>

        <?php 
            echo "<input type='hidden' name='count' value='1".count($data)."'>";
        	$data = $proc->getProcessArray();
        	//print_r($data);
        	for ($i=0; $i<count($data); $i++) {
        		echo "</tr><td><input type='checkbox' value='".$data[$i][1]."' name='pid_".$i."'></td><td>".$data[$i][1]."</td><td>".$data[$i][0]."</td><td>".$data[$i][2]."</td><td>".$data[$i][3]."</td><td>".$data[$i][10]."</td></tr>";
        	}
        ?>
    	</table>
    </form>
</fieldset>
<p style="text-align: center; font-weight: 700;">Entwickler: Patrick</p>
