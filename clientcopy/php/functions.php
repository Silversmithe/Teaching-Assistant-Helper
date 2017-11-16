<?php
function dbaccess(){
	$dbhost = "dbserver.engr.scu.edu";
	$servername = "sdb_shoff";
	$username = "shoff";
	$password = "00001072205";


	// Create connection
	$conn = mysqli_connect($dbhost, $username, $password, $servername)
        or die("Error" . mysqli_error($conn));
	return $conn;
	}

$conn = dbaccess();

?>
