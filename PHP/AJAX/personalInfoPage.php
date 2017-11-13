<?php
	$accN=$_REQUEST['q'];
	$servername = "localhost";
	$username = "root";
	$password = "ariz80";
	$dbname = "ibsnetbanking";
	$table="CustomerInfo";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	else{
		$query="SELECT * from CustomerInfo where AccountNumber='$accN'";
		$query_result=mysqli_query($conn,$query);
		if(!$query_result)
			print "Request Unsuccessfull";
		else{
			$arr=array();
			$row=mysqli_fetch_array($query_result);
			for($i=0;$i<12;$i++){
				$arr[$i]=$row[$i];
			}
			$response="<p class='infoTag colorInfo'>Customers Personal Details</p>
			<table id='personalInfoTable'>
				<tr class='PIR'>
					<td>Name</td>
					<td>$arr[1]</td>
				</tr>
				<tr class='PIR'>
					<td>Email</td>
					<td>$arr[9]</td>
				</tr>
				<tr class='PIR'>
					<td>Mobile</td>
					<td>$arr[8]</td>
				</tr>
				<tr class='PIR'>
					<td>Account Number</td>
					<td>$arr[0]</td>
				</tr>
				<tr class='PIR'>
					<td>Address</td>
					<td>$arr[4]</td>
				</tr>
				<tr class='PIR'>
					<td>Aadhar</td>
					<td>NULL</td>
				</tr>
				<tr class='PIR'>
					<td>PAN Details</td>
					<td>NULL</td>
				</tr>
			</table>";
			print $response;
		}
	}
?>