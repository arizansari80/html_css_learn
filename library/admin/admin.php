<?php
session_start();
if(isset($_SESSION["admin"])){
}
else{
header("Location: http://127.0.0.1/php/library/admin.php");
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="admincss.css">
	<script src="jscript.js"></script>
	<script src="jquery-3.1.1.min.js"></script>
</head>
<body>

<script>

	window.onbeforeunload = function () {
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "logout.php", true);
        xmlhttp.send();
	}

	function setflag(x){
		flag=x;
	}

	$(document).ready(function(){
     $("form").submit(function(e){
		    var actWin="#"+actId+actBtn;
		    if(actWin=='#bookstwo'){
		    	if(flag==1){
		    	$(actWin+" #rem").val("");
		    }
		    }
            $.post("process.php", $(actWin).serialize()+"&status="+actWin, function(result) {
            if(result.status==1){
        	$("#result").text(result.msg).css("color","green").delay(1000).fadeOut(1000);
        	setTimeout(function(){$(actWin).find("input[type=text]").val("");},1000);
        	}
        	else {
        		alert("Sorry! some error occured...");
        		$("#result").text(result.msg).css("color","red").delay(500).fadeOut(1000);
        	}
        	$("#result").show();
    });
        e.preventDefault();
    });
});

$(document).ready(function(){
		tables=function(){
		var actWin="#"+actId+actBtn;
		$.post("tables.php", "state="+actWin, function(result) {
			$(actWin).html(result);
		});
	}
});

$(document).ready(function(){
	details=function(p){
		if(p==2) $("#stRoll").val("");
		$.post("details.php", "state="+p+"&roll="+$("#stRoll").val(), function(result) {
			$("#det").html(result);
		});
	}
});
	
</script>

<div class="container">
<div class="top">
<h1><span>ADMIN </span>JAMIA MILLIA ISLAMIA <span>UNIVERSITY</span></h1>
</div>
<aside>
	<table>
		<tr>
		<td><div class="tip" id="a"></div></td>
		<td><button class="btn a" onclick="set(this,'a')">BOOK DETAILS</button></td>
		</tr>
		<tr>
		<td><div class="tip" id="b"></div></td>
		<td><button class="btn" onclick="set(this,'b')">REG STUDENTS</button></td>
		</tr>
		<tr>
		<td><div class="tip" id="c"></div></td>
		<td><button class="btn" onclick="set(this,'c')">ISSUE</button></td>
		</tr>
		<tr>
		<td><div class="tip" id="d"></div></td>
		<td><button class="btn" onclick="set(this,'d')">RETURN</button></td>
		</tr>
	</table>
</aside>

<div class="box" id="books">
		<table class="tbl1">
			<th><button class="one" id="b" onclick="toggle('one')">ADD</button></th>
			<th><button class="two" onclick="toggle('two')">REMOVE</button></th>
			<th><button class="three" onclick="toggle('three');tables()">VIEW</button></th>
		</table><br><br><br>

	<fieldset class="view1">
	<legend><b>ADD BOOK</b></legend>
	<form autocomplete="off" id="booksone" action="">
	<table class="tbl2">
	<tr>
		<td>
		TITLE:<br>
		<input type="text" onkeyup="cleanup(this)" name="title"><br><br>
		</td>
		<td>
		AUTHOR:<br>
		<input type="text" onkeyup="cleanup(this)" name="author"><br><br>
		</td>
	</tr>
	<tr>
		<td>
		PUBLISHER:<br>
		<input type="text" onkeyup="cleanup(this)" name="publisher"><br><br>
		</td>
		<td>
		EDITION:<br>
		<input type="text" onkeyup="cleanup(this)" name="edition"><br><br>
		</td>
	</tr>
	<tr>
		<td>
		ISBN:<br>
		<input type="text" onkeyup="cleanup(this)" name="isbn"><br><br>
		</td>
		<td>
		COUNT:<br>
		<input type="text" onkeyup="cleanup(this)" name="count"><br><br>
		</td>
	</tr>
	<tr>
		<td>
		LOCATION:<br>
		<input type="text" onkeyup="cleanup(this)" name="location"><br><br>
		</td>
	</tr>
	<tr>
		<td><input type="submit" name="submit" value="ADD" onclick="submit()"></td>
	</tr>
	</table>
	</form>
	</fieldset>
	<fieldset class="view2">
		<legend>REMOVE BOOKS</legend>
		<form autocomplete="off" id="bookstwo">
		<table class="tbl3">
			<tr>
			<td>
			ISBN:<br><br>
			<input type="text" onkeyup="cleanup(this)" name="isbn" placeholder="ISBN"><br><br>
			</td>
			<td>
			COUNT:<br><br>
			<input type="text" id="rem" onkeyup="cleanup(this)" name="count" placeholder="COUNT"><br><br>
			</td>
			</tr>
			<tr>
			<td><input class="danger" type="submit" name="remall" value="REMOVE ALL" onclick="setflag(1)"></td>
			<td><input class="danger" type="submit" name="remove" value="REMOVE" onclick="setflag(0)"></td>
			</tr>
		</table>
		</form>
	</fieldset>
	<fieldset class="view3">
	<legend>VIEW BOOKS</legend>
	<div class="field" id="booksthree"></div>
	</fieldset>
</div>

<div  class="box" id="student">
	<table class="tbl1">
			<th><button class="one" onclick="toggle('one')">ADD STUDENT</button></th>
			<th><button class="two" onclick="toggle('two')">STUDENT DETAILS</button></th>
			<th><button class="three" onclick="toggle('three')">REMOVE</button></th>
		</table><br><br><br>

	<fieldset class="view1">
		<legend>STUDENT REGISTRATION</legend>
		<form autocomplete="off" id="studentone">
			<table class="tbl2">
				<tr>
					<td>
						NAME:<br>
						<input type="text" onkeyup="cleanup(this)" name="name" placeholder="NAME"><br><br>
						ROLL NO:<br>
						<input type="text" onkeyup="cleanup(this)" name="roll" placeholder="ROLL"><br><br>
						GENDER:<br>
						<input type="radio" name="gender" value="M" checked>M<br>
						<input type="radio" name="gender" value="F">F<br><br>
						<input type="submit" name="submit" value="REGISTER">
					</td>
				</tr>
			</table>
		</form>
	</fieldset>

	<div class="view2">
		<form autocomplete="off" style="padding-left: 10px;" id="studenttwo">
			ENTER ROLL :<br>
			<input type="text" onkeyup="cleanup(this)" name="roll" id="stRoll" placeholder="ROLL" style="width: 20%; height: 25px; padding-left: 5px; min-width: 100px;">
			<input type="submit" name="submit" value="SUBMIT" style="width: 10%; height: 30px; min-width: 80px;" onclick="details(1)">&nbsp;
			<input type="submit" name="submit" value="SHOW ALL" style="width: 12%; height: 30px; min-width: 80px;" onclick="details(2)">
		</form><br>
		<fieldset>
			<legend>DETAILS</legend>
			<div id="det">
			<!-- <p><b>NAME:</b> AAMIR &nbsp; <b>ROLL:</b> 14BCS0058</p>
			<p>BOOKS ISSUED :</p>
			<div class="details">
			<table class="tbl4">
			<tr>
				<th>TITLE</th>
				<th>AUTHOR</th>
				<th>ISSUE DATE</th>
				<th>STATUS</th>
			</tr>
			<tr>
				<td>THE NAME OF THE ROSES</td>
				<td>EMILY JACKSON</td>
				<td>12/06/2016</td>
				<td>RETURNED</td>
			</tr>
			<tr>
				<td>THE NAME OF THE ROSES</td>
				<td>EMILY JACKSON</td>
				<td>12/06/2016</td>
				<td>RETURNED</td>
			</tr>
			<tr>
				<td>THE NAME OF THE ROSES</td>
				<td>EMILY JACKSON</td>
				<td>12/06/2016</td>
				<td>RETURNED</td>
			</tr>
			<tr>
				<td>THE NAME OF THE ROSES</td>
				<td>EMILY JACKSON</td>
				<td>12/06/2016</td>
				<td>RETURNED</td>
				<tr>
				<td>THE NAME OF THE ROSES</td>
				<td>EMILY JACKSON</td>
				<td>12/06/2016</td>
				<td>RETURNED</td>
			</tr>
			<tr>
				<td>THE NAME OF THE ROSES</td>
				<td>EMILY JACKSON</td>
				<td>12/06/2016</td>
				<td>RETURNED</td>
			</tr>
			<tr>
				<td>THE NAME OF THE ROSES</td>
				<td>EMILY JACKSON</td>
				<td>12/06/2016</td>
				<td>RETURNED</td>
			</tr>
			<tr>
				<td>THE NAME OF THE ROSES</td>
				<td>EMILY JACKSON</td>
				<td>12/06/2016</td>
				<td>RETURNED</td>
			</tr>
			<tr>
				<td>THE NAME OF THE ROSES</td>
				<td>EMILY JACKSON</td>
				<td>12/06/2016</td>
				<td>RETURNED</td>
			</tr>
			<tr>
				<td>THE NAME OF THE ROSES</td>
				<td>EMILY JACKSON</td>
				<td>12/06/2016</td>
				<td>RETURNED</td>
			</tr>
			<tr>
				<td>THE NAME OF THE ROSES</td>
				<td>EMILY JACKSON</td>
				<td>12/06/2016</td>
				<td>RETURNED</td>
			</tr>
			<tr>
				<td>THE NAME OF THE ROSES</td>
				<td>EMILY JACKSON</td>
				<td>12/06/2016</td>
				<td>RETURNED</td>
			</tr>
			<tr>
				<td>THE NAME OF THE ROSES</td>
				<td>EMILY JACKSON</td>
				<td>12/06/2016</td>
				<td>RETURNED</td>
			</tr>
			</tr>
			</table> 
			</div>-->
			</div>
		</fieldset>
	</div>
		<fieldset class="view3">
		<legend>REMOVE STUDENT</legend>
			<form autocomplete="off" style="padding-left: 10px;" id="studentthree">
			ENTER ROLL :<br>
			<input type="text" onkeyup="cleanup(this)" name="roll" placeholder="ROLL" style="width: 20%; height: 25px; padding-left: 5px; min-width: 100px;">
			<input class="danger" type="submit" name="submit" value="REMOVE" style="width: 10%; height: 30px; min-width: 80px;">
		</form><br>
		</fieldset>
</div>

<div class="box" id="issue">
	<table class="tbl1">
			<th><button class="one" onclick="toggle('one')">ISSUE</button></th>
			<th><button class="two" onclick="toggle('two');tables()">RECORD</button></th>
			<th><button class="three" onclick="toggle('three');tables()">PENDING</button></th>
	</table><br><br><br>
	<fieldset class="view1">
	<legend>ISSUE A NEW BOOK</legend>
		<form autocomplete="off" id="issueone">
			<table class="tbl2">
				<tr>
					<td>
						ROLL NO: <br><br>
						<input type="text" onkeyup="cleanup(this)" name="roll" placeholder="ROLL"><br><br>
					</td>
					<td>
						ISBN:<br><br>
						<input type="text" onkeyup="cleanup(this)" name="isbn" placeholder="ISBN"><br><br>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" name="submit" value="ISSUE">
					</td>
				</tr>
			</table>
		</form>
		
	</fieldset>
	<fieldset class="view2">
		<legend>RECORD</legend>
		<div class="field" id="issuetwo">
			<!-- <table class="tbl4">
				<tr>
					<th>STUDENT'S ROLL</th>
					<th>TITLE</th>
					<th>ISBN</th>
					<th>ISSUE DATE</th>
					<th>EXP RETURN DATE</th>
				</tr>
			</table> -->
		</div>
	</fieldset>
	<fieldset class="view3">
		<legend>PENDING</legend>
		<div class="field" id="issuethree">
			<!-- <table class="tbl4">
				<tr>
					<th>ROLL</th>
					<th>BOOK/TITLE</th>
					<th>AUTHOR</th>
					<th>ISSUE DATE</th>
					<th>RETURN DATE</th>
				</tr>
				<tr>
					<td>14BCS0058</td>
					<td>MICRO-BIOLOGY AND ITS APPLICATIONS</td>
					<td>JACOB STERN</td>
					<td>12/06/2016</td>
					<td>10/07/2016</td>
				</tr>
			</table> -->
		</div>
	</fieldset>
</div>

<div class="box" id="return">
	<table class="tbl1">
			<th><button class="one" onclick="toggle('one')">RETURN</button></th>
			<th><button class="two" onclick="toggle('two');tables()">RECORD</button></th>
	</table><br><br><br>
	<fieldset class="view1">
	<legend>RETURN BOOK</legend>
		<form autocomplete="off" id="returnone">
			<table class="tbl2">
				<tr>
					<td>
						ROLL NO: <br><br>
						<input type="text" onkeyup="cleanup(this)" name="roll" placeholder="ROLL"><br><br>
					</td>
					<td>
						ISBN:<br><br>
						<input type="text" onkeyup="cleanup(this)" name="isbn" placeholder="ISBN"><br><br>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" name="submit" value="RETURN">
					</td>
				</tr>
			</table>
		</form>
		
	</fieldset>
	<fieldset class="view2">
		<legend>RECORD</legend>
		<div class="field" id="returntwo">
			<!-- <table class="tbl4">
				<tr>
					<th>STUDENT'S ROLL</th>
					<th>BOOK/TITLE</th>
					<th>ISBN</th>
					<th>ISSUED ON</th>
					<th>RETURNED ON</th>
				</tr>
				<tr>
					<td>14BCS0058</td>
					<td>MICRO-BIOLOGY AND ITS APPLICATIONS</td>
					<td>JACOB STERN</td>
					<td>12/06/2016</td>
					<td>10/07/2016</td>
				</tr>
			</table> -->
		</div>
	</fieldset>
</div>

</div>
<div id="result" style="position: absolute; top: 50%; left: 40%; transform: translate(-50%,0); font-size: 50px;"></div>
</body>
</html>