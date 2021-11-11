<?php
session_start();

$status=$_POST["status"];

$db = new PDO('mysql:host=localhost;dbname=library;charset=utf8',  $_SESSION["admin"], $_SESSION["adminpwd"]);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$arr=array();

switch($status)
{
	case '#booksone':
		$t=$_POST["title"];
		$a=$_POST["author"];
		$p=$_POST["publisher"];
		$e=$_POST["edition"];
		$c=$_POST["count"];
		$l=$_POST["location"];
		$i=$_POST["isbn"];
		$str="INSERT INTO BOOKS(TITLE,AUTHOR,EDITION,PUBLISHER,NUM,ISBN,LOCATION) VALUES ('$t','$a','$e','$p',$c,$i,'$l')";
		try{
			$db->query($str);
			$arr["status"]=1;
			$arr["msg"]="success!";
			echo json_encode($arr);
		}catch(PDOException $exc){
			$arr["status"]=0;
			$arr["msg"]="operation failed!";
			echo json_encode($arr);
		}
		break;

	case '#bookstwo':
			$count=$_POST["count"];
			$isbn=$_POST["isbn"];
			if( $count!=""){
				$str="UPDATE BOOKS SET NUM=NUM-$count WHERE ISBN=$isbn";
				$chk="SELECT NUM FROM BOOKS WHERE ISBN=$isbn";
				$flag=1;
				$remaining=0;
				$r=$db->query($chk);
				foreach($r as $row) {
					if($row['NUM']<=$count){ $GLOBALS['flag']=0; }
					$GLOBALS['remaining']=$row['NUM']-$count;
				}

				try{
					if($flag==1){
						$r=$db->query($str);
					if($r->rowCount()==0) {
						$arr["status"]=0;
						$arr["msg"]="no such isbn exists!";
					}
					else {
						$arr["status"]=1;
						$arr["msg"]="remaining $remaining books";
					}
					}
					else {
						$arr["status"]=0;
						$arr["msg"]="Can't remove $count no of books!";
					}
				echo json_encode($arr);
				}catch(PDOException $exc){
				$arr["status"]=0;
				$arr["msg"]="operation failed! check if book exists or if you are removing more books than available!";
				echo json_encode($arr);
				}
			
			}
			else {
				$str="DELETE FROM BOOKS WHERE ISBN=$isbn";
				try{
					$r=$db->query($str);
					
					if($r->rowCount()==0) {
						$arr["status"]=0;
						$arr["msg"]="no such isbn exists!";
					}
					else{
						$arr["status"]=1;
						$arr["msg"]="removed all books with isbn=$isbn";
					}
					echo json_encode($arr);
				}catch(PDOException $exc){
					$arr["status"]=0;
					$arr["msg"]="operation failed!";
					echo json_encode($arr);
				}
			}
			break;

case '#studentone':
		$name=$_POST["name"];
		$roll=$_POST["roll"];
		$gender=$_POST["gender"];
		if($name!="" && $roll!="" && $gender!=""){
		$str="INSERT INTO STUDENTS(NAME,ROLL,GENDER) VALUES ('$name','$roll','$gender')";
				try{
					$r=$db->query($str);
					$arr["status"]=1;
					$arr["msg"]=$name.' successfully added!';
					echo json_encode($arr);
				}catch(PDOException $exc){
							$arr["status"]=0;
							$arr["msg"]="operation failed!";
							echo json_encode($arr);
				}
			}
			else{
				$arr["status"]=0;
				$arr["msg"]="operation failed!";
				echo json_encode($arr);
		}
		break;

case '#studentthree':
		$roll=$_POST["roll"];
		if($roll!=""){
		$str="DELETE FROM STUDENTS WHERE ROLL='$roll'";
				try{
					$r=$db->query($str);
					$arr["status"]=1;
					$arr["msg"]=$roll.' successfully removed!';
					echo json_encode($arr);
				}catch(PDOException $exc){
							$arr["status"]=0;
							$arr["msg"]="operation failed!";
							echo json_encode($arr);
				}
			}
			else{
				$arr["status"]=0;
				$arr["msg"]="operation failed!";
				echo json_encode($arr);
		}
		break;

case '#issueone':
		$roll=$_POST["roll"];
		$isbn=$_POST["isbn"];
		$p=0;
		try{
			$r=$db->query("SELECT NAME FROM STUDENTS WHERE ROLL='$roll'");
			if($r->rowCount()>0){
			$r=$db->query("SELECT * FROM PENDING WHERE ROLL='$roll' AND ISBN=$isbn");
			if($r->rowCount()==0){
				$r=$db->query("SELECT NUM FROM BOOKS WHERE ISBN=$isbn");
				if($r->rowCount()>0){
					foreach ($r as $row) {
						if($row['NUM']>0){
							$GLOBALS['p']=1;
						}
					}
				}
				else{
					$arr["status"]=0;
					$arr["msg"]="the book doesn't exist!";
				}
			}
			else{
				$arr["status"]=0;
				$arr["msg"]="the book already pending!";
			}
			}
			else{
				$arr["status"]=0;
				$arr["msg"]="student not registered!";
			}
			if($p==1){
				$db->query("INSERT INTO PENDING(ROLL,ISBN) VALUES ('$roll',$isbn)");
				$db->query("UPDATE BOOKS SET NUM=NUM-1 WHERE ISBN=$isbn");
				$db->query("INSERT INTO ISSUE(ROLL,ISBN,EXP_RETURN_DATE) VALUES ('$roll',$isbn,NOW() + INTERVAL 15 DAY)");
				$arr["status"]=1;
				$arr["msg"]="successfully issued!";
			}
			echo json_encode($arr);
		}catch(PDOException $exc){
					$arr["status"]=0;
					$arr["msg"]="operation failed!";
					echo json_encode($arr);
			}
			break;

case '#returnone':
		$roll=$_POST["roll"];
		$isbn=$_POST["isbn"];
		try{
			$r=$db->query("DELETE FROM PENDING WHERE ROLL='$roll' AND ISBN=$isbn");
			if($r->rowCount()>0){
			$db->query("INSERT INTO RETURNS(ROLL,ISBN) VALUES ('$roll',$isbn)");
			$db->query("UPDATE BOOKS SET NUM=NUM+1 WHERE ISBN=$isbn");
			$arr["status"]=1;
			$arr["msg"]="successfully returned!";
		}
		else{
			$arr["status"]=0;
			$arr["msg"]="this book wasn't issued!";
		}

			echo json_encode($arr);
		}catch(PDOException $exc){
					$arr["status"]=0;
					$arr["msg"]="operation failed!";
					echo json_encode($arr);
			}
			break;

}

header('Content-Type: application/json');
?>
