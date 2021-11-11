<?php
	// $name="Ariz";
	// $name=str_split($name);
	// // print ord($name[3]);
	// $now=date("ymdGis");
	// // echo $now;
	// $accNumber=intval($now);
	// // echo "<br>".$accNumber;
	// $abc="2017-12-14";
	// $efg=date_create($abc);

	// echo "<br>abc = ".date_format($efg,'Y-m-d');

	$name="Muhammad"."$"."Ariz"."$"."Ansari";
	$gender="Male";
	$temp_date="1996"."-"."09"."-"."12";
	$dob=date("Y-m-d",strtotime($temp_date));
	$addr="C-232 Flat No. 303"."$"."Shaheen Bagh"."$"."Abul Fazal Enclave-II";
	$district="New Delhi";
	$state="Delhi";
	$pin=intval("110025");
	$mob=9716153618;
	$email="arizansari80@gmail.com";
	$accType="Savings Account";

	// for($i=0;$i<10;$i++)
	// 	$ref.=(ord($key[$i])^ord($mob[$i]))%10;

	$refNumber="DL2345214567";

	$now=date("ymdGis");
	if(strlen($now)==11)
		$now=substr($now,0,6)."0".substr($now,6,5);
	$accNumber=intval($now);
	

	//Connection and Insertion


	$server="localhost";
	$user="root";
	$pass="";
	$database="tempibs";
	$temp_db_server_conn=mysqli_connect($server,$user,$pass,$database);

	if(!db_server_conn){
		die("Connection failed: " . mysqli_connect_error());
	}
	else{
		$query="INSERT INTO tempRefNum values ('$refNumber','$accNumber')";
		$result=mysqli_query($temp_db_server_conn,$query);

		if(!$result)
			die("Insertion failed: ".mysqli_error($temp_db_server_conn));
		else{
			$query_query="INSERT INTO tempCustInfo values ('$accNumber','$name','$gender','$dob','$addr','$district','$state','$pin','$mob','$email','$accType')";
			$res_result=mysqli_query($temp_db_server_conn,$query_query);
			if(!$res_result){
				die("Insertion failed: ".mysqli_error($temp_db_server_conn));

			}
			else
				print "Account Request Successfull Your Reference Number is $refNumber";
		}
	}
?>