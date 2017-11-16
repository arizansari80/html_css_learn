<?php
	$myObj=json_decode($_REQUEST['q'],false);

	$masterAcc=intval($myObj->masterAcc);
	$stat=1;

	$servername = "localhost";
	$username = "root";
	$password = "ariz80";
	$dbname = "ibsnetbanking";

	// Create connection
	$responseObj;
	$responseObj->status="Unsuccessfull";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn)
		print $responseObj;
	else{
		$branch=substr($myObj->benifIFSC,6,5);
		$ifsc=$myObj->benifIFSC;
		$benifAcc=intval($myObj->benifAccNumber);
		$benifLimit=intval($myObj->benifLimit);
		$query="INSERT INTO Benificiary values ('$masterAcc','$stat','$benifAcc','$benifName','Indian Bank of States','$branch','$ifsc','$benifLimit')";
		$query_result=mysqli_query($conn,$query);
		if(!$query_result)
			print $responseObj;
		else{
			mysqli_close($conn);
			$responseObj->status="Successfull";
			print $responseObj;
		}
	}

	// $query = "SELECT * FROM referenceNumber";
	// $query_result = mysqli_query($conn, $sql);
?>