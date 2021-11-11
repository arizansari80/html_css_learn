<?php
session_start();

$title=$_GET["title"];
$author=$_GET["author"];
$publisher=$_GET["publisher"];
$isbn=$_GET["isbn"];
$location=$_GET["location"];
$num=$_GET["count"];
$edition=$_GET["edition"];

$db = new PDO('mysql:host=localhost;dbname=library;charset=utf8', $_SESSION["admin"], $_SESSION["adminpwd"]);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$str="INSERT INTO BOOKS(TITLE,AUTHOR,PUBLISHER,EDITION,NUM,ISBN,LOCATION) VALUES
	  ($title,$author,$publisher,$edition,$num,$isbn,$location)";

try{
	$db->query($str);
	echo 'Success!';
}catch(PDOException $e){
	echo $e->getMessage();
}

?>