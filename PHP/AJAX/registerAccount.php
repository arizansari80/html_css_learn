<?php
	$Obj=json_decode($_REQUEST['q'],false);
	$rObj=json_encode($Obj);
	$user=$Obj->user;
	$password=$Obj->password;
	$m=strlen($user);
	$n=strlen($password);
	$u=str_split($user);
	$p=str_split($password);
	$i=0;
	$j=0;
	$ep="";
	while($i<$n){
		$ch=chr((ord($p[$i])^ord($u[$j]))+1);
		$ep.=$ch;
		$i++;
		$j++;
		if($j==$m)
			$j=0;
	}
	$password=$ep;
	$accountNumber=$Obj->accountNumber;
	$recvRefID=$Obj->recvRef;

	//Making Connection

	$servername = "localhost";
	$username = "root";
	$passwordd = "";
	$dbname = "ibsnetbanking";
	$temp="tempibs";

	// Create connection
	$permanent_conn = mysqli_connect($servername, $username, $passwordd, $dbname);
	$temp_db_conn=mysqli_connect($servername, $username, $passwordd,$temp);
	$myObj = new \stdClass;
	$myObj->status="Failed";
	// Check connection
	if (!$permanent_conn||!$temp_db_conn) {
		print json_encode($myObj);
	    die("Connection failed: " . mysqli_connect_error());
	}
	else{
		$query_fetch="SELECT * FROM tempRef WHERE tempRefID='$recvRefID'";
		$query_fetch_res=mysqli_query($temp_db_conn,$query_fetch);
		$row=mysqli_fetch_array($query_fetch_res);
		$d1=$row[0];
		$d2=intval($row[1]);
		$d3=0;

		//Insert Into Perm Reference Table
		$query_ins="INSERT INTO ReferenceID values ('$d1','$d2','$d3')";
		$query_ins_res=mysqli_query($permanent_conn,$query_ins);

		//Getting CustInfo from Temp DB
		$query_fetch="SELECT * FROM tempCustInfo WHERE tempAccNumber='$d2'";
		$query_fetch_res=mysqli_query($temp_db_conn,$query_fetch);
			
		//Data Creation

		$row=mysqli_fetch_array($query_fetch_res);
		$accNumber=intval($row[0]);
		$name=$row[1];
		$gender=$row[2];
		$dob=date("Y-m-d",strtotime($row[3]));
		$addr=$row[4];
		$district=$row[5];
		$state=$row[6];
		$pin=intval($row[7]);
		$mobi=intval($row[8]);
		$email=$row[9];
		$accType=$row[10];

		$query="SELECT BranchName from BankBranches where State='$state'";

		$query_result=mysqli_query($permanent_conn,$query);
		$rowy=mysqli_fetch_array($query_result);

		$Bname=$rowy[0];
		
		//Insert Into Perm Customer Info			
		$query_ins="INSERT INTO CustomerInfo values ('$accNumber','$name','$gender','$dob','$addr','$district','$state','$pin','$mobi','$email','$accType','$Bname')";

		$query_ins_res=mysqli_query($permanent_conn,$query_ins);

		//Insert Into Login Info		
		$query="INSERT INTO LoginInfo values('$user','$password','$accountNumber')";
		$query_result=mysqli_query($permanent_conn,$query);

		//Insert into Account Info
		$query_acc_info="INSERT INTO AccountInfo (UserId,Balance) values('$user','10000')";
		$query_acc_res=mysqli_query($permanent_conn,$query_acc_info);


		//Del Query From Temp DB
		$del_query="DELETE FROM tempRef WHERE tempRefID='$recvRefID'";
		$del_query1="DELETE FROM tempCustInfo WHERE tempAccNumber='$accNumber'";
		$del_res=mysqli_query($temp_db_conn,$del_query);
		$del_res1=mysqli_query($temp_db_conn,$del_query1);
		if($del_res&&$del_res1){
			$qu="UPDATE ReferenceID SET DelPointer='1' WHERE RefID='$recvRefID'";
			$qu_res=mysqli_query($permanent_conn,$qu);
		}
		$myObj->status="Successfull";
		print json_encode($myObj);
	}
	mysqli_close($permanent_conn);
	mysqli_close($temp_db_conn);
?>
