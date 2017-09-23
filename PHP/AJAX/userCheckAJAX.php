<?php
	$myObj=json_decode($_REQUEST['q'],false);
	$servername = "localhost";
	$username = "root";
	$password = "ariz80";
	$dbname = "ibsnetbanking";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	$Obj->status="Failed";
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	    $Obj->from="Conn";
	    print json_encode($Obj);
	}
	else{
		$query="SELECT * FROM LoginInfo WHERE UserId='$myObj->user'";
		$query_result=mysqli_query($conn,$query);
		if(!$query_result){
			$Obj->from="query";
			print json_encode($Obj);
		}
		else{
			$row=mysqli_fetch_array($query_result);
			if(!$row){
				$Obj->from="row";
				$Obj->user=$myObj->user;
				print json_encode($Obj);
			}
			else{
				//Decrypting Password
				
				$pass=$myObj->password;
				$gpass=$row[1];
				$u=str_split($myObj->user);
				$p=str_split($gpass);
				$m=strlen($u);
				$n=strlen($gpass);
				$i=0;
				$j=0;
				$ep="";
				while($i<$n){
					$ch=chr(((ord($p[$i])-1)^ord($u[$j])));
					$ep.=$ch;
					$i++;
					$j++;
					if($j==$m)
						$j=0;
				}
				if(strcmp($pass,$ep)==0){
					$Obj->accN=$row[2];
					$Obj->status="Success";
					print json_encode($Obj);
				}
				else{
					$Obj->from="Strcmp";
					// $Obj->pass=$pass;
					// $Obj->gpass=$ep;
					// $Obj->passg=$gpass;
					print json_encode($Obj);
				}
			}
		}
	}

	//Perform Operation From Here

?>