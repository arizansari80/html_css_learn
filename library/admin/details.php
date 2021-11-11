<?php
session_start();

 $state=$_POST["state"];

$db = new PDO('mysql:host=localhost;dbname=library;charset=utf8',  $_SESSION["admin"], $_SESSION["adminpwd"]);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

if($state==1){
	 $roll=$_POST["roll"];
	 $name="";
	 if($roll==""){echo '<span style="position: relative;top: 50%;left: 40%;font-size:18px;color:gray;">Enter Roll!</span>';}
	else {
		$r=$db->query("SELECT NAME FROM STUDENTS WHERE ROLL='$roll'");
	
		if($r->rowCount()>0){
		foreach ($r as $row) {
			$GLOBALS["name"]=$row["NAME"];
		}
	 	
		echo '<p><b>NAME:</b> '.$name.' &nbsp; <b>ROLL:</b> '.$roll.'</p>
				<p>BOOKS HELD :</p>
				<div class="details">';
	
		$r=$db->query("SELECT B.TITLE,B.AUTHOR,P.ISBN FROM BOOKS B,PENDING P WHERE B.ISBN=P.ISBN AND P.ROLL='$roll'");
	
		if( $r->rowCount()==0){
			echo '<span style="position: relative;top: 50%;left: 40%;font-size:18px;color:gray;">None</span>';
		}
		else{
			echo '<table class="tbl4">
				<tr>
					<th>SNO</th>
					<th>TITLE</th>
					<th>AUTHOR</th>
					<th>ISBN NO</th>
				</tr>';
				$i=1;
			foreach ($r as $row){
				echo '<tr>
						<td>'.$i.'</td>
						<td style="text-align:left">'.$row["TITLE"].'</td>
						<td style="text-align:left">'.$row["AUTHOR"].'</td>
						<td>'.$row["ISBN"].'</td>
					 </tr>';
					 $i++;
			}
			echo '</table>';
		}
				
		   echo "</div>";	
		}
		else {
			echo '<span style="position: relative;top: 50%;left: 40%;font-size:18px;color:gray;">This roll doesn\'t exist</span>';
	
		}
	}

}

else{
	$r=$db->query("SELECT * FROM STUDENTS");
	if($r->rowCount()==0){
		echo '<span style="position: relative;top: 50%;left: 40%;font-size:18px;color:gray;">No student record found!</span>';
	}
	else{
		echo '<div class="details">';
		echo '<table class="tbl4">
			<tr>
				<th>SNO</th>
				<th style="text-align:left">NAME</th>
				<th>ROLL</th>
				<th>GENDER</th>
				<th>REGISTRATION DATE</th>
			</tr>';
			$i=1;
		foreach ($r as $row){
			echo '<tr>
					<td>'.$i.'</td>
					<td style="text-align:left">'.$row["NAME"].'</td>
					<td>'.$row["ROLL"].'</td>
					<td>'.$row["GENDER"].'</td>
					<td>'.$row["REGDATE"].'</td>
				 </tr>';
				 $i++;
		}
		echo '</table>';
		echo "</div>";
	}
}

?>