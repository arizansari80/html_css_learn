<?php
	$server="localhost";
	$user="root";
	$password="";
	$database="ibsnetbanking";

	$response="Unsuccessfull";

	$conn=mysqli_connect($server,$user,$password,$database);
	
	if (!$conn)
		print $response;
	else{
		
	}
?>
