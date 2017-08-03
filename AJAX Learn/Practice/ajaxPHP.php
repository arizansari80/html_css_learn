<?php
	// $q=$_REQUEST['q'];
	// if($q==='1000')
	// 	$b=10;
	// $a="<p style='margin:0 0;height:40px;width:50%;line-height:40px;text-align:center;border:1px solid green;color:blue;border-radius:5px;margin-top:10px;'>";
	// $a.="The value you send is ".$q." and the value of a is $b";
	// $a.="</p>";
	// print "$a";
	// $myObj->name = "John";
	// $myObj->age = 30;
	// $myObj->city = "New York";

	// $myJSON = json_encode($myObj);

	$myObj=json_decode($_REQUEST['q'],false);
	$myJSON = json_encode($myObj);
	print $myJSON;
?>