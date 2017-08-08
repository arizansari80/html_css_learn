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
			if(myObj.status.localeCompare('Success')==0){
				console.log(myObj);
				accn.value=myObj.accN;
			}
			else{
				if(myObj.accN!=0){
					var delAcc=new XMLHttpRequest();

					delAcc.onreadystatechange=function () {
						if(this.readyState==4&&this.status==200){
							console.log(this.responseText);
						}
					}
					delAcc.open("POST","../PHP/AJAX/delMakeAccount.php?q="+refIDSend,true);
					delAcc.send();
				}
				accn.value="Error";
			}
		}
	}
}