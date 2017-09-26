var getProfileFront=document.getElementById('2');
getProfileFront.addEventListener('click',getProfileFrontF);

var profilePassSub=document.getElementById('profilePassSubmit');
if(profilePassSub!=null)
profilePassSub.addEventListener('click',getProfilePage);

var ajaxHttp=new XMLHttpRequest();
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

/*Getting Profile Page*/
function getProfilePage(){
	console.log("In Profile Page AJAX");
	ajaxHttp.open('GET','http://localhost/Project/PHP/AJAX/profileMainPage.php');
	ajaxHttp.send();

	ajaxHttp.onreadystatechange=function(){
		if(ajaxHttp.status==200&&ajaxHttp.readyState==4){
			console.log(this.responseText);
			document.getElementById('mainContent').innerHTML=this.responseText;
		}
	}
}