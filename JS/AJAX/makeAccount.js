var getAccountBtn=document.getElementById('getAccountNumberBtn');

getAccountBtn.addEventListener('click',getAccountNumber);

var ajaxHttp=new XMLHttpRequest();

var openAccBtn=document.getElementById('openAccountBtn');
openAccBtn.disabled=true;
openAccBtn.style.cursor="not-allowed";
openAccBtn.style.background="grey";

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
				// console.log(myObj);
				accn.value=myObj.accN;
				document.getElementById('permanentAccountNumber').value=myObj.accN;
				document.getElementById('branchName').value=myObj.BName;
				if(myObj.BCode.charCodeAt(0)==48)
					myObj.BCode=myObj.BCode.substr(1);
				document.getElementById('branchCode').value=myObj.BCode;
				document.getElementById('ifscCode').value=myObj.IFSC;
				var toAct=document.getElementById('toActivateField').getElementsByTagName('input');
				for (var i = 0; i < toAct.length; i++) {
					toAct[i].className="commonInput compulsory";
					toAct[i].disabled=false;
				}
				openAccBtn.disabled=false;
				openAccBtn.style.cursor="";
				openAccBtn.style.background="#5ea559";
			}
			else
				accn.value="Error";
		}
	}
}

openAccountBtn.addEventListener('click',openAccountFunction);

function openAccountFunction(e){
	var ajaxHttp=new XMLHttpRequest();
	var accInfo={
		recvRef:document.getElementById('referenceID').value,
		accountNumber:document.getElementById('permanentAccountNumber').value,
		user:document.getElementById('userName').value,
		password:document.getElementById('password').value
	}
	var jobj=JSON.stringify(accInfo);
	ajaxHttp.open('POST','../PHP/AJAX/registerAccount.php?q='+jobj,true);
	ajaxHttp.send();

	ajaxHttp.onreadystatechange=function(){
		if(ajaxHttp.status==200&&ajaxHttp.readyState==4){
			var result=document.getElementById('queryResult');
			var myObj=JSON.parse(this.responseText);
			console.log(myObj);
			if(myObj.status.localeCompare("Successfull")==0){
				result.className="myVisibilityShow bgSuccess colorSuccess";
				result.innerText="Account Open Successfully";
				queryResult.style.lineHeight="70px";
				var inp=$('input');
				inp.each(function(i){
					this.disabled=true;
				});
			}
			else{
				result.className="myShow bgWarning colorWarning";
				result.innerText="Service is temporary unavailabe";
				queryResult.style.lineHeight="70px";
			}
		}
	}
}