var baseHead;
var accountSummaryMainContent;
window.onload=function(){
	accountSummaryMainContent=document.getElementById('mainContent').
		innerHTML;
	baseHead=document.getElementsByTagName('head');
	baseHead=baseHead[0].innerHTML;
}
var accPageLoad=document.getElementById('1');
accPageLoad.addEventListener('click',loadPage);

function loadPage(){
	console.log("In Click 1");
	document.getElementById('mainContent').innerHTML=accountSummaryMainContent;
	document.getElementsByTagName('head')[0].innerHTML=baseHead;
}

var toShowPage=["profilePage"];
var profilePageLoad=document.getElementById('2');
profilePageLoad.addEventListener('click',loadProfilePage);

function loadProfilePage(){
	console.log("In Click 2");
	document.getElementById('mainContent').innerHTML=document.getElementById('profilePage').innerHTML;
	document.getElementsByTagName('head')[0].innerHTML=baseHead+"<link rel='stylesheet' href='../CSS/ProfilePageCSS.css'>";		
}