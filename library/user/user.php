<?php
session_start();
if(isset($_SESSION["user"])){
}
else{
header("Location: http://127.0.0.1/php/library/user.php");
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Search Library</title>
	<link rel="stylesheet" type="text/css" href="st.css">
	<script type="text/javascript" src="user.js"></script>
</head>
<body>
<script>
function request() {
		if( title.length<3 && author.length<3 && publisher.length<3 && isbn.length<3 ){
			document.getElementById("display").innerHTML = "<legend><b>SEARCH RESULTS</b></legend>";
			return;
		}
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("display").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "response.php?title="+title+"&author="+author+"&publisher="+publisher+"&isbn="+isbn+"&sort="+sort, true);
        xmlhttp.send();
}
</script>

<div class="left_box">
	<div class="filter_box">
	<h4>FITER OR SEARCH :</h4>
	<form name="filter" action="#">
		<span>TITLE:</span><br>
		<input type="checkbox" name="bk_ttl" value="bk_ttl" checked="checked" onclick="check()">
		<input type="text" name="ttl" placeholder="TITLE" onkeyup="cleanup(this);request()">
		<br><br>
		<span>AUTHOR:</span><br>
		<input type="checkbox" name="bk_atr" value="bk_atr" checked="checked" onclick="check()">
		<input type="text" name="atr" placeholder="AUTHOR" onkeyup="cleanup(this);request()">
		<br><br>
		<span>PUBLISHER:</span><br>
		<input type="checkbox" name="bk_pbl" value="bk_pbl" checked="checked" onclick="check()">
		<input type="text" name="pbl" placeholder="PUBLISHER" onkeyup="cleanup(this);request()">
		<br><br>
		<span>ISBN:</span><br>
		<input type="checkbox" name="bk_isb" value="bk_isb" class="isbn" onclick="uncheck()">
		<input type="text" name="isb" placeholder="ISBN" style="background-color: gray" onkeyup="cleanup(this);request()">
	</form>
	<button onclick="reset()">RESET</button>
	</div>

	<div class="right_box">
		<div class="top">
			<p><img src="Logo.svg" style=" padding-left: 10px; width: 120px; height: 120px;">
			<span>JAMIA MILLIA ISLAMIA UNIVERSITY</span>
			<button onclick="order();request()">SORT BY EDITION</button>
			</p>
		</div>
		<div class="clk">
		<p id="dat"></p>
		<p id="tm"></p>
		</div>
		<hr><br>
		<div class="bottom">
		<fieldset id="display">
			<legend><b>SEARCH RESULTS</b></legend>
			<!-- <div id="tbl">
			</div> -->
		</fieldset>	
		</div>
	</div>
</div>
</body>
</html>