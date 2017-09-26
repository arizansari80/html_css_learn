<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<link rel="stylesheet" href="../CSS/myCustom.css">
		<link rel="stylesheet" href="../CSS/accountMainPageCSS.css">
		<link rel="stylesheet" href="../CSS/ProfilePageCSS.css">
	</head>
	<body>
		<?php
			$server="localhost";
			$user="root";
			$pass="ariz80";
			$database="ibsnetbanking";
			$table="BankBranches";
			$conn=mysqli_connect($server,$user,$pass,$database);
			if(!$conn)
				print "Connection Failed";
			else{
				//Data Preparation
				$jsObj=array();
				$jsObj[0]=$_POST['acc'];
				$accN=$_POST['acc'];
				$query="SELECT Name,Email,Mobile FROM CustomerInfo WHERE AccountNumber='$accN'";
				$query_result=mysqli_query($conn,$query);
				$row=mysqli_fetch_array($query_result);
				$jsObj[1]=$row[0];
				$jsObj[2]=$row[1];
				$jsObj[3]=$row[2];
				$user=$_POST['user'];
				$query="SELECT Balance FROM AccountInfo WHERE UserId='$user'";
				$query_result=mysqli_query($conn,$query);
				$row=mysqli_fetch_array($query_result);
				$jsObj[4]=$row[0];

				//HTML Design
				$abc="<header class='totalWidth'>
			<div></div>
			<div>
				<p class='noMargin colorSuccess' id='userName' style='marginRight:10px;'>Welcome: </p>
				<a href='../HTML/LogInPage.html' id='logout'>Logout</a>
			</div>
		</header>
		<nav id='mainMenu' class='totalWidth bgSuccessHard'>
			<ul class='myFlexDisplay totalWidth showClickEffect'>
				<li class='flexMenuItem Active' id='1'>My Account</li>
				<li class='flexMenuItem' id='2'>Profile</li>
				<li class='flexMenuItem' id='3'>Payement/Transfer</li>
				<li class='flexMenuItem' id='4'>Enquiries</li>
				<li class='flexMenuItem' id='5'>Manage Account</li>	
			</ul>
		</nav>
		<div class='mainContainer myFlexDisplay totalWidth'>
			<nav class='sideMenu totalHeight'>
				<!-- ul.mainMenu>li.menuItem* -->
			</nav>
			<main id='mainContent' class='totalHeight'>
				<p class='infoTag colorInfo'>Account Summary</p>
				<div class='mainContentClass'>
					<p class='giveBold bgSuccess noMargin'>Account Details</p>
					<table class='contentTable'>
						<tr class='categoryInfo'>
							<td>Account Number</td>
							<td class='loginUpdate'></td>
						</tr>
						<tr class='categoryInfo'>
							<td>Name</td>
							<td class='loginUpdate'></td>
						</tr>
						<tr class='categoryInfo'>
							<td>Email</td>
							<td class='loginUpdate'></td>
						</tr>
						<tr class='categoryInfo'>
							<td>Mobile</td>
							<td class='loginUpdate'></td>
						</tr>
						<tr class='categoryInfo'>
							<td>Clear Balance</td>
							<td class='loginUpdate'></td>
						</tr>
						<tr class='categoryInfo'>
							<td>Currency</td>
							<td>INR</td>
						</tr>
					</table>
				</div>
			</main>
		</div>
		<footer></footer>";
					print $abc;
					// }
				}
		?>


		<!-- Hidden Objects -->

		<!-- <section class="myHidden" id="profilePage">
			<p id="infoTag" class="colorInfo">Account Profile</p>
			<div class="mainContentClass">
				<section>
					<input type="password" id="profilePassTextBox"><br>
					<button type="button" id="profilePassSubmit" class="myButton">Submit</button>
					<p id="forgotProfilePassword">Forgot Profiel Password?</p>
					<p id="changeProfilePassword">Change Profiel Password</p>
					<p class="colorWarning myHidden">*Wrong Password</p>
				</section>	
			</div>
		</section> -->
		<script src="../JS/jquery-3.2.1.js"></script>
		<script src="../JS/myCustom.js"></script>
		<!-- <script src="../JS/accountMainPageJS.js"></script> -->
		<script>
			var myObj=<?php print json_encode($jsObj)?>;

			var ch=myObj[1].split('');
			var f=myObj[1].indexOf('$');
			var l=myObj[1].lastIndexOf('$');
			ch[f]=' ';
			ch[l]=' ';
			var i=0;
			myObj[1]="";
			for(;i<ch.length;i++)
				myObj[1]+=ch[i];
			i=0;
			var updateOnLogin=$('.loginUpdate');
			updateOnLogin.each(function(){
				this.innerText=myObj[i++];
			});
			$('#userName')[0].innerText+=" "+myObj[1]+" ";
		</script>
		<script src="../JS/AJAX/accountMainPageAJAX.js"></script>
		<script src="../JS/pageManipulate.js"></script>
	</body>
</html>