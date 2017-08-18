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