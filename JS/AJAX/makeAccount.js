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
				console.log(myObj);
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