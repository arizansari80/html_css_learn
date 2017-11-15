<?php
	$reply="<p class='infoTag colorInfo'>Add Benificiary</p>
			<table id='personalInfoTable'>
				<tr class='PIR'>
					<td>Name</td>
					<td><input type='text'></td>
				</tr>
				<tr class='PIR'>
					<td>Account Number</td>
					<td><input type='text' class='onlyNumber'></td>
				</tr>
				<tr class='PIR'>
					<td>Confirm Account Number</td>
					<td><input type='text' class='onlyNumber'></td>
				</tr>
				<tr class='PIR'>
					<td>Branch</td>
					<td><input type='text'></td>
				</tr>
				<tr class='PIR'>
					<td>IFSC Code</td>
					<td><input type='text'></td>
				</tr>
				<tr class='PIR'>
					<td>Branch Code</td>
					<td><input type='text' class='onlyNumber'></td>
				</tr>
				<tr class='PIR'>
					<td>Benificiary Limit</td>
					<td><input type='text' class='onlyNumber'></td>
				</tr>
			</table>
			<section id='buttonAddBenifSection' class='myFlexDisplay'>
				<button type='button' id='addBenif'>Add Benificiary</button>
				<button type='button' id='resetBenif'>Reset</button>
			</section>";
	print $reply;	
?>