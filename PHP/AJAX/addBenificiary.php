<?php
	$myObj=json_decode($_REQUEST['q'],false);

	$masterAcc=$myObj->masterAcc;

	$servername = "localhost";
	$username = "root";
	$password = "ariz80";
	$dbname = "ibsnetbanking";

	// Create connection
	$responseObj;
	$responseObj->status="Unsuccessfull";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		print $responseObj;
	}
	else{
		$branch=$myObj->benifIFSC;
		$query="INSERT INTO Benificiary values ('$masterAcc',0,'$myObj->benifAccNumber','$benifName','Indian Bank of States','')"
	}

	// $query = "SELECT * FROM referenceNumber";
	// $query_result = mysqli_query($conn, $sql);
?>