<?php 

	$servername = "localhost"; 
	$username = "root"; 
	$password = ""; 

	$database = "taxitest"; 

	// Create a connection 
	$conn = mysqli_connect($servername, $username, $password, $database); 

	
	if($conn) { 
		echo "connection is success"; 
	} 
	else { 
		die("Error". mysqli_connect_error()); 
	} 
?> 
