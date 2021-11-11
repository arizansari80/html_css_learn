<?php
	$senderObj=json_decode($_REQUEST['q'],false);

	$senderName=$senderObj->userName;
	$senderBranch=$senderObj->senderBranchName;
	$masterAccountNumber=$senderObj->senderAccNumber;

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ibsnetbanking";
	$responseObj = new \stdClass;
	$responseObj->status="Failed";
	$responseObj->text="";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		$myJSON=json_encode($responseObj);
		print $myJSON;
	    die("Connection failed: " . mysqli_connect_error());
	}
	else{
		$query="SELECT UserId FROM LoginInfo WHERE AccountNumber='$masterAccountNumber'";
		$query_result=mysqli_query($conn,$query);
		$row=mysqli_fetch_array($query_result);
		$query="SELECT Balance FROM AccountInfo WHERE UserId='$row[0]'";
		$query_result=mysqli_query($conn,$query);
		$row=mysqli_fetch_array($query_result);
		$senderBalance=$row[0];
		$firstPart="<p class='infoTag colorInfo'>Payement/Transfer Section</p>
			<table id='senderInfoTable'>
				<tr>
					<th><input type='radio' style='visibility:hidden'></th>
					<th>Sender Option</th>
					<th>Name of Bank</th>
					<th>Branch Name</th>
					<th>Account Number</th>
					<th>Balance</th>
				</tr>
				<tr>
					<td><input type='radio' checked='true'></td>
					<td>$senderName</td>
					<td>Indian Bank of States</td>
					<td>$senderBranch</td>
					<td class='debitAccountNumber'>$masterAccountNumber</td>
					<td>$senderBalance</td>
				</tr>
			</table>
			<table id='payementInfoTable'>
				<tr>
					<th>Selected Account Number</th>
					<td id='senderAccountNumber'>$masterAccountNumber</td>
				</tr>
				<tr>
					<th>Amount</th>
					<td><input type='text' id='amountToTransfer' class='onlyNumber'></td>
					<td class='myHidden pleaseFill' style='font-size:12px;'>*Please Fill</td>
					<td class='myHidden balanceNotSufficient' style='font-size:12px;'>*Balance Not Sufficient</td>
				</tr>
				<tr>
					<th>Remarks</th>
					<td><input type='text' id='remarksGiven'></td>
				</tr>
			</table>";

		$secondPart="<table id='benifListTable' border='0'>
				<tr>
					<th><input type='radio' style='visibility:hidden'></th>
					<th>Benificiary Name</th>
					<th>Name of Bank</th>
					<th>Branch Name</th>
					<th>Account Number</th>
					<th>IFSC Code</th>
					<th>Benificiary Limit</th>
				</tr>";

		$query="SELECT BenificiaryName,BenificiaryBank,BenificiaryBranch,BenificiaryAccount,BenificiaryIFSC,BenificiaryLimit FROM Benificiary WHERE PointerAccount='$masterAccountNumber'";
		$query_result=mysqli_query($conn,$query);
		if(!$query_result){
			$myJSON=json_encode($responseObj);
			print $myJSON;
		}
		else{
			while($row=mysqli_fetch_assoc($query_result)){
				$row=array_values($row);
				$secondPart.="<tr>
							<td><input type='radio' name='creditAccountChoice'></td>";
				$secondPart.="<td>$row[0]</td>";
				$secondPart.="<td>$row[1]</td>";
				$secondPart.="<td>$row[2]</td>";
				$secondPart.="<td class='creditAccountNumber'>$row[3]</td>";
				$secondPart.="<td>$row[4]</td>";
				$secondPart.="<td>$row[5]</td>";
				$secondPart.="</tr>";
			}
			$secondPart.="</table>";
			$thirdPart="<section id='payementButtonSection' class='myFlexDisplay'>
				<button type='button' id='payNow'>Pay Now</button>
				<button type='button' id='resetPayNow'>Clear</button>
			</section>";
			$responseObj->status="success";
			$responseObj->text=$firstPart.$secondPart.$thirdPart;
			$responseObj=json_encode($responseObj);
			print $responseObj;
		}
	}
?>