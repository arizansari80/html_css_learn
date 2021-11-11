<?php
session_start();

$title=$_GET["title"];
$author=$_GET["author"];
$publisher=$_GET["publisher"];
$isbn=$_GET["isbn"];
$sort=$_GET["sort"];

$db = new PDO('mysql:host=localhost;dbname=library;charset=utf8', $_SESSION["user"], $_SESSION["pwd"]);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

if( strlen($isbn)== 0 ){
	$str="SELECT * FROM BOOKS WHERE TITLE LIKE '%$title%' AND AUTHOR LIKE '%$author%' AND PUBLISHER LIKE '%$publisher%' ORDER BY EDITION $sort";
}
else {
	$str="SELECT * FROM BOOKS WHERE ISBN LIKE '$isbn%'";
}

try{
	$req=$db->query($str);
	$count=$req->rowCount();
	echo "<legend><b>SEARCH RESULTS (".$count.")</b></legend>";
	echo '<div id="tbl">';
	if($count>0){
		echo '<table>';
		echo   "<tr>
					<th>SNO</th>
					<th>TITLE</th>
					<th>AUTHOR</th>
					<th>EDITION</th>
					<th>PUBLISHER</th>
					<th>ISBN NO</th>
					<th>LOCATION</th>
				</tr>";
	$i=1;
	foreach($req as $row) {
    	echo   "<tr>
					<td style='text-align:center'>".$i."</td>
					<td>".$row['TITLE']."</td>
					<td>".$row['AUTHOR']."</td>
					<td style='text-align:center'>".$row['EDITION']."</td>
					<td>".$row['PUBLISHER']."</td>
					<td style='text-align:center'>".$row['ISBN']."</td>
					<td style='text-align:center'>".$row['LOCATION']."</td>
				</tr>";
				$i++;
}
echo '</table>';
}
	else{
	echo '<span style="position: relative;top: 50%;left: 40%;font-size:18px;color:gray;">Sorry, no match found for your query!</span>';
}
echo '</div>';

}catch(PDOException $e){
	echo $e->getMessage();
}

?>
