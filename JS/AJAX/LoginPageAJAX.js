var btn=document.getElementById('loginSubmitBtn');
var myForm=document.getElementById('loginForm');

// btn.addEventListener('click',changeText);
btn.addEventListener('click',checkUser);

function changeText(){
	this.value="Signing In...";
}

function checkUser(){
	var ajaxHttp=new XMLHttpRequest();
	var myObj={
		user:document.getElementById('user').value,
		password:document.getElementById('pass').value
	}
	var jObj=JSON.stringify(myObj);
	ajaxHttp.open('POST',"../PHP/AJAX/userCheckAJAX.php?q="+jObj);
	ajaxHttp.send();

	ajaxHttp.onreadystatechange=function(){
		if(ajaxHttp.status==200&&ajaxHttp.readyState==4){
			console.log(this.responseText);
			var myObj=JSON.parse(this.responseText);
			if(myObj.status.localeCompare('Success')==0){
				// sleep(5000);
				document.getElementById('AccountNumber').value=myObj.accN;
				myForm.submit();
			}
			else{
				console.log("From JS Unsuccessfull");
			}
		}
	}
}

function sleep(ti){
	var t=new Date().getTime()+ti;
	while(new Date().getTime()<=t);
}