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
$proc = new \Classes\Module\Tools\Process();

if (isset($_POST['kill'])) {
    for ($i=0;$i<6000;$i++) {
        if (isset($_POST["pid_".$i])) {
            $pid = $_POST["pid_".$i];
            $server->execute("kill ".$pid);
        }
    }
}

?>

<h3>Taskmanager<sup>ALPHA</sup></h3>
<fieldset>
    <form action="index.php?p=system&s=taskmgr" method="post">
        <input type="submit" value="Prozess beenden" name="kill" class="button black">
        <input type="submit" value="H&ouml;here Priorit&auml;t" name="nice" class="button black"> <hr>

    	<table id="sortable" class="s">
            <thead>
                <tr><? $data = $proc->getProcessArray();
                echo "</tr><td></td><th>".$data[0][1]."</th><th>".$data[0][0]."</th><th>".$data[0][2]."</th><th>".$data[0][3]."</th><th>".$data[0][10]."</th></tr>"; ?></tr>
            </thead>
            <tbody>
        <?php 
            echo "<input type='hidden' name='count' value='1".count($data)."'>";
        	for ($i=1; $i<count($data); $i++) {
        		echo "</tr><td><input type='checkbox' value='".$data[$i][1]."' name='pid_".$i."'></td><td>".$data[$i][1]."</td><td>".$data[$i][0]."</td><td>".$data[$i][2]."</td><td>".$data[$i][3]."</td><td>".$data[$i][10]."</td></tr>";
        	}
        ?></tbody>
    	</table>
    </form>
</fieldset>
<p style="text-align: center; font-weight: 700;">Entwickler: Patrick</p>
