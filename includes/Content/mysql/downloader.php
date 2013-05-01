<?php
session_start();
$datei = '../../../tmp/mysql/export/'.session_id().'.sql';
$dateiname = basename($datei);
$size = filesize($datei);
header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=".$dateiname);
header("Content-Length:".$size);
readfile($datei);
?>
