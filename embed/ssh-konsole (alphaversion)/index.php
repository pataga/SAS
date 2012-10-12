<?php
require 'libs/Net/SSH2.php';
$ausgabe = "";
$ssh = new Net_SSH2("192.168.0.105");
$ssh->login("gabriel","Mango11"); // USER,PW
if (isset($_POST["command"]))
   $ausgabe = $ssh->exec($_POST['command']); //BEFEHL
?>
<body bgcolor="#090909" style="font-family:monospace;">
<center>
<style type="text/css">
TEXTAREA {
 background-color: black;
 color: white;
 width:500px;
 height:300px; 
 resize: none;
 border: 2px solid #fff;
 padding: 5px;
}
</style>
<br><br><br><br><br>
<form action="index.php" method="post">
<textarea readonly="readonly"><?php echo $ausgabe; ?></textarea><br>
<input type="text" name="command" style="width:300px;height:auto;font-size:1.1em; font-family:monospace;"><input type="submit" style="width:auto;height:25px;font-size:1.1em; ">
</form>

</Center>
</body>