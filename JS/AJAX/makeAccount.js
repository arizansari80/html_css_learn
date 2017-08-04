var getAccountBtn=document.getElementById('getAccountNumberBtn');

getAccountBtn.addEventListener('click',getAccountNumber);

var ajaxHttp=new XMLHttpRequest();

function getAccountNumber(){
	var refIDSend=document.getElementById('referenceID').value;

	ajaxHttp.open('POST','../PHP/AJAX/makeAccount.php?q='+refIDSend,true);
	ajaxHttp.send();

	ajaxHttp.onreadystatechange=function(){
		if(ajaxHttp.status==200&&ajaxHttp.readyState==4){
			var myObj=JSON.parse(this.responseText);
			console.log(myObj);
			var accn=document.getElementById('fetchedAccountNumber');
			if(myObj.status.localeCompare('Success')==0)
				accn.value=myObj.accN;
			else
				accn.value="Error";
		}
	}
}