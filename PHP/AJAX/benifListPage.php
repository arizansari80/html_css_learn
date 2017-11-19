<?php
	$firstPart="<p class='infoTag colorInfo'>Payement/Transfer Section</p>
			<table id='benifListTable' border='0'>
				<tr>
					<th><input type='radio' style='visibility:hidden'></th>
					<th>Benificiary Name</th>
					<th>Name of Bank</th>
					<th>Branch Name</th>
					<th>Account Number</th>
					<th>IFSC Code</th>
					<th>Benificiary Limit</th>
				</tr>";

	$thirdPart="</table>
			<section id='payementButtonSection' class='myFlexDisplay totalWidth'>
				<button type='button' id='payNow'>Pay Now</button>
				<button type='button' id='payNow'>Clear</button>
			</section>";

	$masterAccountNumber=$_REQUEST['q'];
	$servername = "localhost";
	$username = "root";
	$password = "ariz80";
	$dbname = "ibsnetbanking";

	// Create connection

	$responseObj->status="Failed";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		$myJSON=json_encode($responseObj);
		print $myJSON;
	    die("Connection failed: " . mysqli_connect_error());
	}
	else{
		$query="SELECT BenificiaryName,BenificiaryBank,BenificiaryBranch,BenificiaryAccount,BenificiaryIFSC,BenificiaryLimit FROM Benificiary WHERE PointerAccount='$masterAccountNumber'";
		$query_result=mysqli_query($conn,$query);
		if(!$query_result){
			$myJSON=json_encode($responseObj);
			print $myJSON;
		}
		else{
			while($row=mysqli_fetch_assoc($query_result)){
				$row=array_values($row);
				$secondPart="<tr>
							<td><input type='radio' name='creditAccountChoice'></td>";
				for($i=0;$i<6;$i++){
					$secondPart.="<td>";
					$secondPart.=$row[$i];
					$secondPart.="</td>";
				}
				$secondPart.="</tr>";
			}
			$responseObj->status="success";
			$responseObj->text=$firstPart.$secondPart.$thirdPart;
			$myJSON=json_encode($responseObj);
			print $myJSON;
		}
	}
?>