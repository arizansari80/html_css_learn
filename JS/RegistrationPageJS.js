// // menu Bar Click Effect

// var menuElement=document.getElementsByClassName('myFlexMember');
// var preAct="firstE";
// for (var i = 0; i < menuElement.length; i++) 
// 	menuElement[i].addEventListener('click',toActivate);

// function toActivate(e){
// 	var key=e.target.tagName;
// 	if(key.indexOf('A')==0)
// 		getLi=e.target.parentElement;
// 	else
// 		getLi=e.target;
// 	if(preAct.localeCompare(getLi.id)!=0){
// 		getLi.className+=' myFlexMemberActive';
// 		var deact=document.getElementById(preAct);
// 		var z=deact.className.indexOf('myFlexMemberActive');
// 		deact.className=deact.className.substr(0,z);
// 		preAct=getLi.id;
// 	}
// }

//Button Activator

var sendMailBtn=document.getElementById('getRefBtn');
sendMailBtn.disabled=true;
sendMailBtn.style.cursor="not-allowed";
sendMailBtn.style.background="grey";

var compl=document.getElementsByClassName('compulsory');

for (var i = 0; i < compl.length; i++)
	compl[i].addEventListener('blur',enableCheck);

// var toEnable=setInterval('enableCheck',1000);

function enableCheck(){
	var n=compulsoryFill.length;
	var ctr=0;
	for(i=0;i<n;i++){
		if(compulsoryFill[i].nextElementSibling.className.indexOf("fine")!=-1)
			ctr++;
	}
	if(ctr==n){
		sendMailBtn.disabled=false;
		sendMailBtn.style.cursor="";
		sendMailBtn.style.background="";
	}
	else{
		sendMailBtn.disabled=true;
		sendMailBtn.style.cursor="not-allowed";
		sendMailBtn.style.background="grey";
	}
	console.log("counter="+ctr);
}

// function triggerIt(){
// 	// if(++key==12){
// 	// 	toEnable=setInterval(enableCheck,1000);
// 	// }
// 	// else if(key>12){
// 	// 	toEnable=setInterval(enableCheck,1000);	
// 	// 	sendMailBtn.disabled=true;
// 	// 	sendMailBtn.style.cursor="not-allowed";
// 	// 	sendMailBtn.style.background="grey";
// 	// 	key--;
// 	// }
// 	if(key==12){
// 		sendMailBtn.disabled=false;
// 		sendMailBtn.style.cursor="";
// 		sendMailBtn.style.background="";
// 		clearInterval(toEnable);
// 	}
// }