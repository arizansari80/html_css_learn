<?php
	
	$refID=intval($_REQUEST['q']);

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ibsnetbanking";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn)
	    print mysqli_connect_error();
	else{
		$query = "DELETE FROM ReferenceID WHERE RefID='$refID'";
		$query_result = mysqli_query($conn,$query);
		if(!$query_result)
			print "Unsuccessfull "+mysqli_error();
		else{
			mysqli_commit($conn);
			print "Successfully Deleted";
		}
	}
	mysqli_close($conn);
?>