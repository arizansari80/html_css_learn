var getProfileFront=document.getElementById('2');
getProfileFront.addEventListener('click',getProfileFrontF);

var getPayementFront=document.getElementById('3');
getPayementFront.addEventListener('click',getPayementF);

var mainContent=document.getElementById('mainContent');

var profilePassSub=document.getElementById('profilePassSubmit');
if(profilePassSub!=null)
profilePassSub.addEventListener('click',getProfilePage);

var ajaxHttp=new XMLHttpRequest();
var masterAccountNumber=document.getElementById('masterAccountNumber').value;
/*Getting Profile Front*/
function getProfileFrontF(){
	// console.log("In Profile Front Page AJAX");
	ajaxHttp.open('GET','http://localhost:81/Project/PHP/AJAX/profileFrontPage.php');
	ajaxHttp.send();

	ajaxHttp.onreadystatechange=function(){
		if(ajaxHttp.status==200&&ajaxHttp.readyState==4){
			// console.log(this.responseText);
			document.getElementById('mainContent').innerHTML=this.responseText;
			profilePassSub=document.getElementById('profilePassSubmit');
			profilePassSub.addEventListener('click',getProfilePage);
		}
	}
}

var getPD;
var addBenifLink;
/*Getting Profile Page*/
function getProfilePage(){
	console.log("In Profile Page AJAX");
	ajaxHttp.open('GET','http://localhost:81/Project/PHP/AJAX/profileMainPage.php');
	ajaxHttp.send();

	ajaxHttp.onreadystatechange=function(){
		if(ajaxHttp.status==200&&ajaxHttp.readyState==4){
			// console.log(this.responseText);
			document.getElementById('mainContent').innerHTML=this.responseText;
			getPD=document.getElementById('getPersonalDetail');
			getPD.addEventListener('click',getPersonalInfoPage);
			addBenifLink=document.getElementById('addBenifLink');
			addBenifLink.addEventListener('click',getAddBenifPage);
		}
	}
}

/*Getting Personal Information Page*/
function getPersonalInfoPage(){
	var accNo=document.getElementById('masterAccountNumber');
	console.log(accNo.value);
	ajaxHttp.open('POST','http://localhost:81/Project/PHP/AJAX/personalInfoPage.php?q='+accNo.value);
	ajaxHttp.send();

	ajaxHttp.onreadystatechange=function(){
		if(ajaxHttp.status==200&&ajaxHttp.readyState==4){
			document.getElementById('mainContent').innerHTML=this.responseText;
		}
	}
}

/*Getting Add Benificiary Page*/
var addBenifButton;
var resetButtonBenif;
function getAddBenifPage(){
	ajaxHttp.open('GET','http://localhost:81/Project/PHP/AJAX/getBenificiaryPage.php');
	ajaxHttp.send();
	ajaxHttp.onreadystatechange=function(){
		if(ajaxHttp.status==200&&ajaxHttp.readyState==4){
			document.getElementById('mainContent').innerHTML=this.responseText;
			console.log("In Add Benif Account Number"+masterAccountNumber);
			addBenifButton=document.getElementById('addBenif');
			resetButtonBenif=document.getElementById('resetBenif');
			addBenifButton.addEventListener('click',addBenif);
			resetButtonBenif.addEventListener('click',resetBenif);
			document.getElementById('buttonAddBenifSection').style.justifyContent='space-between';
			getOnlyNum();
		}
	}
}

function addBenif(){
	var addBenifJS={
		masterAcc:masterAccountNumber,
		benifName:document.getElementById('addBenifName').value,
		benifAccNumber:document.getElementById('addBenifAccNumber').value,
		benifIFSC:document.getElementById('addBenifIFSC').value,
		benifLimit:document.getElementById('addBenifLimit').value,
		benifBranch:document.getElementById('addBenifBranchName').value
	};
	var addBenifJSON=JSON.stringify(addBenifJS);
	ajaxHttp.open('POST','http://localhost:81/Project/PHP/AJAX/addBenificiary.php?q='+addBenifJSON);
	ajaxHttp.send();

	ajaxHttp.onreadystatechange=function(){
		if(ajaxHttp.readyState==4&&ajaxHttp.status==200){
			var showDiv=document.getElementById('addBenifStatusDiv');
			if(this.responseText.localeCompare("Successfull")==0){
				showDiv.innerText="Benificiary Addition Successfull";
				showDiv.className="myVisibilityShow bgSuccess colorSuccess";
			}
			else{
				showDiv.innerText="Benificiary Addition Failed";
				showDiv.className="myVisibilityShow bgWarning colorWarning";	
			}
		}
	}
}

function resetBenif(){

}

var transferLinkPage;

function getPayementF(){
	ajaxHttp.open('GET','http://localhost:81/Project/PHP/AJAX/payementPage.php');
	ajaxHttp.send();

	ajaxHttp.onreadystatechange=function(){
		if(ajaxHttp.status==200&&ajaxHttp.readyState==4){
			mainContent.innerHTML=this.responseText;
			transferLinkPage=document.getElementById('transferLinkPage');
			transferLinkPage.addEventListener('click',getLinkPage);
		}
	}
}

var amountToTransfer;
var payNowButton;

function getLinkPage(){
	var senderInfo={
		userName:senderName,
		senderAccNumber:masterAccountNumber,
		senderBranchName:senderBranch
	};
	senderInfo=JSON.stringify(senderInfo);
	ajaxHttp.open('POST','http://localhost:81/Project/PHP/AJAX/benifListPage.php?q='+senderInfo);
	ajaxHttp.send();

	ajaxHttp.onreadystatechange=function(){
		if(ajaxHttp.status==200&&ajaxHttp.readyState==4){
			var myJSON=JSON.parse(this.responseText);
			console.log(myJSON);
			if(myJSON.status.localeCompare('success')==0){
				mainContent.innerHTML=myJSON.text;
				payNowButton=document.getElementById('payNow');
				payNowButton.addEventListener('click',transferNowFunction);
				// amountToTransfer=document.getElementById('amountToTransfer');
				// amountToTransfer.addEventListener('blur',checkAvailBalance);
				getOnlyNum();
			}
		}
	}
}

var creditAccountNumber;
var debitAccountNumber;

function transferNowFunction(){
	var creditChoiceArr=document.getElementsByName('creditAccountChoice');
	var l=creditChoiceArr.length;
	var z;
	for(var i=0;i<l;i++){
		console.log(creditChoiceArr[i].checked);
		if(creditChoiceArr[i].checked==true){
			console.log("Yeah");
			z=creditChoiceArr[i];
			break;
		}
	}
	var focusAccount=z.parentElement.parentElement;
	creditAccountNumber=focusAccount.getElementsByClassName('creditAccountNumber')[0].innerText;
	creditAccountNumber=parseInt(creditAccountNumber);
	debitAccountNumber=document.getElementsByClassName('debitAccountNumber')[0].innerText;
	debitAccountNumber=parseInt(debitAccountNumber);
}

var parE;

function checkAvailBalance(e){
	if(e.target.value==""){
		e.target.parentElement.nextElementSibling.nextElementSibling.className="myShow balanceNotSufficient";
	}
}