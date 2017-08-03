// menu Bar Click Effect

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