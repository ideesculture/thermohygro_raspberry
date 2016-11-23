<?php
$json = file_get_contents("http://192.168.0.200/readsensor/");
if($json === false) {
	print "Error : host is down or unreachable.\n";
} else {
	$result = json_decode($json);

	$mysqli = mysqli_connect("localhost", "root", "fo8xj8qv", "readsensor");

	$request = "insert into temperature (station, value) values (1, ".$result->temp.");";
	$res = mysqli_query($mysqli, $request);

	$request = "insert into hygrometry (station, value) values (1, ".$result->hygro.");";
	$res = mysqli_query($mysqli, $request);	
	
	print "Result temp = ".$result->temp." ; hygro = ".$result->hygro."\n";

}
