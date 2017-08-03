<?php
	// include('Math/BigInteger.php');

	$servername = "localhost";
	$username = "root";
	$password = "ariz80";
	$dbname = "ibsnetbanking";

	echo date('ymdGis');

	$now=date("ymdGis");
	if(strlen($now)==11)
		$now=substr($now,0,7)."0".substr($now,7,4);

	$abc="2017-12-14";
	$efg=new Date($abc);

	echo "<br>abc = $abc";
	
	// echo "<br> Now=$now<br>";

	// Create connection
	// $conn = mysqli_connect($servername, $username, $password, $dbname);
	// // Check connection
	// if (!$conn) {
	//     die("Connection failed: " . mysqli_connect_error());
	// }

 //    $num=170731233819;
    // $acc = new Math_BigInteger($num);

	// echo "Connection To DB successfull";
	// $ref="DL20152018";
	// $sql = "INSERT INTO referenceNumber values ('$ref','$num')";
	// if (mysqli_query($conn, $sql)) {
 //    	echo "New record created successfully";
	// } 
	// else {
 //    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	// }
	// if (mysqli_num_rows($result) > 0) {
	//     // output data of each row
	//     while($row = mysqli_fetch_assoc($result)) {
	//         echo "ReferenceNumber " . $row["ReferenceNumber"]. " - Account: " . $row["AccountNumber"]."<br>";
	//     }
	// } else {
	//     echo "0 results";
	// }

	// mysqli_close($conn);
?>