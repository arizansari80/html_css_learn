<?php
session_start();

$user=$_POST["user"];
$pwd=$_POST["pwd"];

try{
	$db = new PDO('mysql:host=localhost;dbname=library;charset=utf8', $user, $pwd);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$_SESSION["user"]=$user;
	$_SESSION["pwd"]=$pwd;
	header("Location: http://127.0.0.1/php/library/user/user.php");
}
catch(PDOException $e){
	$_SESSION["retryuser"]=1;
	header("Location: http://127.0.0.1/php/library/user.php");
}

?>