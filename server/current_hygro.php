<?php

header('Content-Type: application/json');

$con = mysqli_connect("localhost", "root", "fo8xj8qv", "readsensor");//Database connection

// Check connection
if (mysqli_connect_errno($con))
{
	echo "Failed to connect to DataBase: " . mysqli_connect_error();
}
else
{
	$data_points = array();
	$result = mysqli_query($con, "SELECT * FROM hygrometry order by id desc limit 1");

	while($row = mysqli_fetch_array($result))
	{
		//var_dump($row);die();
		$point = array($row['datetime'], $row['value']);
		array_push($data_points, $point);
	}

	echo json_encode($data_points, JSON_NUMERIC_CHECK);

}

mysqli_close($con);

?>