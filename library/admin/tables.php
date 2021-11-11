<?php
session_start();
$state=$_POST["state"];

$db = new PDO('mysql:host=localhost;dbname=library;charset=utf8',  $_SESSION["admin"], $_SESSION["adminpwd"]);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

switch($state){

case '#booksthree':
		try{
			$r=$db->query("SELECT * FROM BOOKS ORDER BY TITLE");
				if($r->rowCount()==0){
					echo '<span style="position: relative;top: 50%;left: 40%;font-size:18px;color:gray;">Sorry, no record exists!</span>';
		
				}
				else{
					echo '<table class="tbl4">';
				echo   "<tr>
							<th>SNO</th>
							<th>TITLE</th>
							<th>AUTHOR</th>
							<th>EDITION</th>
							<th>PUBLISHER</th>
							<th>REMAINING</th>
							<th>ISBN NO</th>
							<th>LOCATION</th>
						</tr>";
						$i=1;
				foreach($r as $row) {
		    	echo   "<tr>
							<td>".$i."</td>
							<td style='text-align:left'>".$row['TITLE']."</td>
							<td style='text-align:left'>".$row['AUTHOR']."</td>
							<td>".$row['EDITION']."</td>
							<td style='text-align:left'>".$row['PUBLISHER']."</td>
							<td>".$row['NUM']."</td>
							<td>".$row['ISBN']."</td>
							<td>".$row['LOCATION']."</td>
						</tr>";
						$i++;
						}
		
				echo '</table>';
				}
			}catch(PDOException $exc){
				echo "$exc->getMessage()";
			}
		break;

case '#issuetwo':
	try{
		$str="SELECT I.ROLL,B.TITLE,I.ISBN,I.ISSUE_DATE,I.EXP_RETURN_DATE FROM BOOKS B,ISSUE I WHERE B.ISBN=I.ISBN ORDER BY I.ISSUE_DATE DESC";
			$r=$db->query($str);
			if($r->rowCount()==0){
			echo '<span style="position: relative;top: 50%;left: 40%;font-size:18px;color:gray;">Sorry,no record exists!</span>';
			 }
	
			else {
				echo '<table class="tbl4">';
				echo   "<tr>
						<th>SNO</th>
						<th>ROLL</th>
						<th>TITLE</th>
						<th>ISBN NO</th>
						<th>ISSUE DATE</th>
						<th>EXP. RET DATE</th>
					</tr>";
					$i=1;
			foreach($r as $row) {
	    		echo   '<tr>
						<td>'.$i.'</td>
						<td>'.$row["ROLL"].'</td>
						<td style="text-align:left">'.$row["TITLE"].'</td>
						<td>'.$row["ISBN"].'</td>
						<td>'.$row["ISSUE_DATE"].'</td>
						<td>'.$row["EXP_RETURN_DATE"].'</td>
					</tr>';
					$i++;
					}
	
				echo '</table>';
			}
		}catch(PDOException $exc){
				echo "$exc->getMessage()";
			}
	break;

case '#issuethree':
	try{
		$str="SELECT P.ROLL,B.TITLE,P.ISBN FROM BOOKS B,PENDING P WHERE B.ISBN=P.ISBN ORDER BY P.ROLL";
			$r=$db->query($str);
			if($r->rowCount()==0){
			echo '<span style="position: relative;top: 50%;left: 40%;font-size:18px;color:gray;">Sorry,YEAH no record exists!</span>';
			 }
	
			else {
				echo '<table class="tbl4">';
				echo   "<tr>
						<th>SNO</th>
						<th>ROLL</th>
						<th>TITLE</th>
						<th>ISBN NO</th>
					</tr>";
					$i=1;
			foreach($r as $row) {
	    		echo   "<tr>
						<td>".$i."</td>
						<td>".$row['ROLL']."</td>
						<td style='text-align:left'>".$row['TITLE']."</td>
						<td>".$row['ISBN']."</td>
					</tr>";
					$i++;
					}
	
				echo '</table>';
			}
		}catch(PDOException $exc){
				echo "$exc->getMessage()";
			}
	break;

case '#returntwo':
	try{
			$str="SELECT R.ROLL,B.TITLE,R.ISBN,R.RETURN_DATE FROM BOOKS B,RETURNS R WHERE B.ISBN=R.ISBN ORDER BY R.RETURN_DATE DESC";
			$r=$db->query($str);
			if($r->rowCount()==0){
			echo '<span style="position: relative;top: 50%;left: 40%;font-size:18px;color:gray;">Sorry,YEAH no record exists!</span>';
			 }
	
			else {
				echo '<table class="tbl4">';
				echo   "<tr>
						<th>SNO</th>
						<th>ROLL</th>
						<th>TITLE</th>
						<th>ISBN NO</th>
						<th>RET DATE</th>
					</tr>";
					$i=1;
			foreach($r as $row) {
	    		echo   "<tr>
						<td>".$i."</td>
						<td>".$row['ROLL']."</td>
						<td style='text-align:left'>".$row['TITLE']."</td>
						<td>".$row['ISBN']."</td>
						<td>".$row['RETURN_DATE']."</td>
					</tr>";
					$i++;
					}
	
				echo '</table>';
			}
		}catch(PDOException $exc){
				echo "$exc->getMessage()";
			}
	break;


}