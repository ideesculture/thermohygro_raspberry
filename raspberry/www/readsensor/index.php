<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
// Lecture température
$result = file("/opt/readsensor/readsensor.txt");
$result = explode("\n",trim(shell_exec("/opt/readsensor/readsensor.sh 18 23 2>&1")));
print json_encode(array("temp"=>trim($result[0]), "hygro"=>trim($result[1])));
