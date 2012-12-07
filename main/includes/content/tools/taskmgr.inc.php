<h3> Hier ensteht die Seite "Taskmanager"</h3>
<fieldset>
	<table>
    <?php 
    	$proc = new Process($main);
    	$data = $proc->getProcessArray();
    	//print_r($data);
    	for ($i=0; $i<count($data); $i++) {
    		echo "</tr><td>".$data[$i][1]."</td><td>".$data[$i][0]."</td><td>".$data[$i][2]."</td><td>".$data[$i][3]."</td><td>".$data[$i][10]."</td></tr>";
    	}
    ?>
	</table>
</fieldset>
<p style="text-align: center; font-weight: 700;">Entwickler: Patrick</p>
