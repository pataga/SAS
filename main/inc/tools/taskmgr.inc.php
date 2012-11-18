
    <?php
        $ssh = new Net_SSH2("localhost");
        $ssh->login("gabriel", "12345");
        $output .= $ssh->exec("ps ax");
        
        echo "<textarea style='width:400px;height:500px;'>$output</textarea>";
    ?>
