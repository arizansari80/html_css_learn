<?php
	$reply="<p class='infoTag colorInfo'>Add Benificiary</p>
			<table id='personalInfoTable'>
				<tr class='PIR'>
					<td>Name</td>
					<td><input type='text' id='addBenifName'></td>
				</tr>
				<tr class='PIR'>
					<td>Account Number</td>
					<td><input type='text' class='onlyNumber' id='addBenifAccNumber'></td>
				</tr>
				<tr class='PIR'>
					<td>Confirm Account Number</td>
					<td><input type='text' class='onlyNumber' id='addBenifConfAccNumber'></td>
				</tr>
				<tr class='PIR'>
					<td>IFSC Code</td>
					<td><input type='text' id='addBenifIFSC'></td>
				</tr>
				<tr class='PIR'>
					<td>Branch Code</td>
					<td><input type='text' class='onlyNumber' id='addBenifBranchCode'></td>
				</tr>
				<tr class='PIR'>
					<td>Benificiary Limit</td>
					<td><input type='text' class='onlyNumber' id='addBenifLimit'></td>
				</tr>
			</table>
			<section id='buttonAddBenifSection' class='myFlexDisplay'>
				<div class='myFlexDisplay'>
					<button type='button' id='addBenif'>Add Benificiary</button>
					<button type='button' id='resetBenif'>Reset</button>
				</div>
				<div id='addBenifStatusDiv'></div>
			</section>";
	print $reply;	
?>