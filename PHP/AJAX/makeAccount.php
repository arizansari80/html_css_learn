<?php
	$recvRefID=$_REQUEST['q'];

	//Connection Establisment

	$servername = "localhost";
	$username = "root";
	$password = "ariz80";
	$dbname = "ibsnetbanking";

	$myObj->status="Failed";

	// Create connection
	$permanent_conn=mysqli_connect($servername,$username,$password,$dbname);
	$temp_db_conn=mysqli_connect($servername,$username,$password,"tempibs");
	// Check connection
	if (!$permanent_conn||!$temp_db_conn) {
	    $myObj->accN=0;
	    $myJSON=json_encode($myObj);
	    print $myJSON;
	}
	else{
		$query_acc="SELECT tempAccNumber FROM tempRef WHERE 	tempRefID='$recvRefID'";
		$query_acc_res=mysqli_query($temp_db_conn,$query_acc);
		$row=mysqli_fetch_array($query_acc_res);
		$accNumber=$row[0];

		
		/*Get State*/
		$query_fetch_state="SELECT state from tempCustInfo WHERE tempAccNum='$accNumber'";
		$query_state_res=mysqli_query($temp_db_conn,$query_fetch_state);
		$row=mysqli_fetch_array($query_state_res);
		$state=$row[0];
		$myObj->state=$state;


		/*Get Branch Info*/
		$query_fetch="SELECT * FROM BankBranches WHERE State='$state'";
		$query_fetch_res=mysqli_query($permanent_conn,$query_fetch);
		if(!$query_fetch_res){
			$myObj->error=mysqli_error();
			$myObj->From="From BankBranches";
			$myObj->accN=1;
		    $myJSON=json_encode($myObj);
			print $myJSON;		
		}
		else{
			$row1=mysqli_fetch_array($query_fetch_res);
			$myObj->BName=$row1[1];
			$myObj->IFSC=$row1[2];
			$myObj->BCode=substr($row1[2],5);
			$myObj->status="Success";
			$myObj->accN=$accNumber;
		    $myJSON=json_encode($myObj);
	    	print $myJSON;
		}							
	}
	mysqli_close($permanent_conn);
	mysqli_close($temp_db_conn);
?>