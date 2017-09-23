<?php
	$myObj=json_decode($_REQUEST['q'],false);

	$key=$myObj[0].$myObj[2];
	$key=str_split($key);
	$mob=$myObj[11];
	$mob=str_split($mob);
	$ref="";

//Data Preparation

	$name=$myObj[0]."$".$myObj[1]."$".$myObj[2];
	// echo $name;
	$gender=$myObj[13];
	//echo $gender;
	$temp_date=$myObj[4]."-".$myObj[14]."-".$myObj[3];
	$dob=date("Y-m-d",strtotime($temp_date));
	// echo $dob;
	$addr=$myObj[5]."$".$myObj[6]."$".$myObj[7];
	// echo $addr;
	$district=$myObj[8];
	// echo $district;
	$state=$myObj[9];
	// echo $state;
	$pin=intval($myObj[10]);
	// echo $pin;
	$mobi=intval($myObj[11]);
	// echo $mobi;
	$email=$myObj[12];
	// echo $email;
	$accType=$myObj[15];
	// echo $accType;

	for($i=0;$i<10;$i++)
		$ref.=(ord($key[$i])^ord($mob[$i]))%10;

	$str=stristr("DL Delhi MU Mumbai CH Chennai KO Kolkata",$state,true);
	$str=substr($str,strlen($str)-3,2);

	$refID=$str.$ref;

	$now=date("ymdGis");
	if(strlen($now)==11)
		$now=substr($now,0,6)."0".substr($now,6,5);
	$accNumber=intval($now);
	

//Connection and Insertion


	$server="localhost";
	$user="root";
	$pass="ariz80";
	$database="tempibs";
	$temp_db_server_conn=mysqli_connect($server,$user,$pass,$database);

	$myObj1->status="Unsuccessfull";

	if(!$temp_db_server_conn){
		$myObj1->refID=0;
		$myJSON=json_encode($myObj1);
		print $myObj1;
	}
	else{
		$query="INSERT INTO tempRef values ('$refID','$accNumber')";
		$result=mysqli_query($temp_db_server_conn,$query);

		if(!$result){
			$myObj1->refID=0;
			$myJSON=json_encode($myObj1);
			print $myJSON;
		}
		else{
			mysqli_commit($temp_db_server_conn);
			$query_query="INSERT INTO tempCustInfo values ('$accNumber','$name','$gender','$dob','$addr','$district','$state','$pin','$mobi','$email','$accType')";
			$res_result=mysqli_query($temp_db_server_conn,$query_query);
			if(!$res_result){
				$myObj1->refID=$refID;
				$myJSON=json_encode($myObj1);
				print $myJSON;
			}
			else{
				mysqli_commit($temp_db_server_conn);
				$myObj1->status="Successfull";
				$myObj1->refID=$refID;
				$myJSON=json_encode($myObj1);
				print $myJSON;
			}
		}
	}
	mysqli_close($temp_db_server_conn);
?>