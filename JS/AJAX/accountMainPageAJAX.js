var getProfileFront=document.getElementById('2');
getProfileFront.addEventListener('click',getProfileFrontF);

var profilePassSub=document.getElementById('profilePassSubmit');
if(profilePassSub!=null)
profilePassSub.addEventListener('click',getProfilePage);

var ajaxHttp=new XMLHttpRequest();
var masterAccountNumber=document.getElementById('masterAccountNumber');
/*Getting Profile Front*/
function getProfileFrontF(){
	console.log("In Profile Front Page AJAX");
	ajaxHttp.open('GET','http://localhost/Project/PHP/AJAX/profileFrontPage.php');
	ajaxHttp.send();

	ajaxHttp.onreadystatechange=function(){
		if(ajaxHttp.status==200&&ajaxHttp.readyState==4){
			console.log(this.responseText);
			document.getElementById('mainContent').innerHTML=this.responseText;
			profilePassSub=document.getElementById('profilePassSubmit');
			profilePassSub.addEventListener('click',getProfilePage);
		}
	}
}

var getPD;
/*Getting Profile Page*/
function getProfilePage(){
	console.log("In Profile Page AJAX");
	ajaxHttp.open('GET','http://localhost/Project/PHP/AJAX/profileMainPage.php');
	ajaxHttp.send();

	ajaxHttp.onreadystatechange=function(){
		if(ajaxHttp.status==200&&ajaxHttp.readyState==4){
			// console.log(this.responseText);
			document.getElementById('mainContent').innerHTML=this.responseText;
			getPD=document.getElementById('getPersonalDetail');
			getPD.addEventListener('click',getPersonalInfoPage);
		}
	}
}

/*Getting Personal Information Page*/
function getPersonalInfoPage(){
	var ajaxHttp=new XMLHttpRequest();
	var accNo=document.getElementById('masterAccountNumber');
	console.log(accNo.value);
	ajaxHttp.open('POST','http://localhost/Project/PHP/AJAX/personalInfoPage.php?q='+accNo.value);
	ajaxHttp.send();

	ajaxHttp.onreadystatechange=function(){
		if(ajaxHttp.status==200&&ajaxHttp.readyState==4){
			console.log(this);
			console.log(this.responseText);
		}
	}
} 