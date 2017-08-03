// Login Aside Image Random Select

(function(){
	var loginAsideImage=document.getElementById('loginAsideImage');
	var k=Math.random();
	k=(k*10);
	k=Math.ceil(k);
	k=k%4+1;
	var str="../Images/logInAsideImage";
	str+=k+".jpg";
	loginAsideImage.src=str;
})();

//Menu Bar Click Effect

var menuElement=document.getElementsByClassName('myFlexMember');
var preAct="firstE";
for (var i = 0; i < menuElement.length; i++) 
	menuElement[i].addEventListener('click',toActivate);

function toActivate(e){
	var key=e.target.tagName;
	if(key.indexOf('A')==0)
		getLi=e.target.parentElement;
	else
		getLi=e.target;
	if(preAct.localeCompare(getLi.id)!=0){	
		getLi.className+=' myFlexMemberActive';
		var deact=document.getElementById(preAct);
		var z=deact.className.indexOf('myFlexMemberActive');
		deact.className=deact.className.substr(0,z);
		preAct=getLi.id;
	}
}

//Login Submit Button Prevent Default

var loginSubmitBtn=document.getElementById('loginSubmitBtn');
loginSubmitBtn.addEventListener('click',justInitial);

function justInitial(e){
	e.preventDefault();
}

//To Scroll Down
var warningTag=document.getElementById('warningTag');
warningTag.addEventListener('click',scollDownCus);

function scollDownCus(){
	$('html,body').animate(
		{scrollTop: document.body.scrollHeight},2000
	);
}