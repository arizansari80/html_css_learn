<?php
session_start();

$user=$_POST["user"];
$pwd=$_POST["pwd"];

try{
	$db = new PDO('mysql:host=localhost;dbname=library;charset=utf8', $user, $pwd);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$_SESSION["admin"]=$user;
	$_SESSION["adminpwd"]=$pwd;
	header("Location: http://127.0.0.1/php/library/admin/admin.php");
}
catch(PDOException $e){
	$_SESSION["retry"]=1;
	header("Location: http://127.0.0.1/php/library/admin.php");
}

?>