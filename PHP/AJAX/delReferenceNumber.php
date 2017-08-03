<?php
	
	$refN=intval($_REQUEST['q']);

	$servername = "localhost";
	$username = "root";
	$password = "ariz80";
	$dbname = "tempibs";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn)
	    print mysqli_connect_error();
	else{
		$query = "DELETE FROM tempRefNum WHERE tempRefNumber='$refN'";
		$query_result = mysqli_query($conn,$query);
		if(!$query_result)
			print mysqli_error();
		else
			print "Successfully Deleted";
	}
?>