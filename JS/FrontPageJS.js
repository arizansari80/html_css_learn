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

var animeUpLi=document.getElementsByClassName('animeUpLi');
var animeUpUl=document.getElementsByClassName('animeUpUl');
var heightLi=animeUpLi[0].clientHeight;
var numAnimeUpLi=animeUpLi.length;
heightLi/=numAnimeUpLi;
for(i=0;i<numAnimeUpLi;i++)
	animeUpLi[i].style.height=heightLi;

var servicesText=document.getElementsByClassName('readMore');
for(var i=0;i<servicesText.length;i++)
	servicesText[i].addEventListener('click',showServicesText);

function showServicesText(e){
	var preEle=e.target.previousElementSibling;
	if(e.target.innerText.localeCompare("Read More")==0){
		preEle.className+=" serviceTextActive";
		e.target.innerText="Read Less";
	}
	else{
		preEle.className="servicesOfferText";
		e.target.innerText="Read More";
	}

}