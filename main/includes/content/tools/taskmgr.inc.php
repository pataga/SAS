<h3> Hier ensteht die Seite "Taskmanager"</h3>
<fieldset>
    <?php 
    	$proc = new Process($main);
    	$data = $proc->getProcessArray();
    	print_r($data);
    	for ($i=0; $i<3; $i++) {
    		echo $data[$i][0];
    	}
    ?>
</fieldset>
<p style="text-align: center; font-weight: 700;">Entwickler: Patrick</p>