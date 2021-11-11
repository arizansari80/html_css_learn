var actId="books";
var actBtn="one";
var map={"books":0,"student":1,"issue":2,"return":3};
var btnMap={"one":"view1","two":"view2","three":"view3"}
var sideMap={"a":"books","b":"student","c":"issue","d":"return"}

var cleanup=function(elem){
			elem.value=elem.value.toUpperCase();
			elem.value=elem.value.replace(/^\s/,"");
			elem.value=elem.value.replace(/\s{2,}/g," ");
		}
		
function unset(){ //unset sidebutton state
	var x=document.getElementsByClassName("tip");
	var y=document.getElementsByClassName("btn");
	document.getElementById(actId).style.display="none";
	x[map[actId]].style.display="none";
	y[map[actId]].style.backgroundColor="#232222";
	y[map[actId]].style.color="gray";
}

var set=function(ref,id){  //set sidebutton state
	unset();
	document.getElementById(id).style.display="block";
	ref.style.backgroundColor="black";
	ref.style.color="#0b2ef3";
	actId=sideMap[id];
	document.getElementById(actId).style.display="block";
	toggle("one");
}

var toggle=function(btncls){  //toggle button states and corresponding views

	var x=document.getElementsByClassName(btnMap[actBtn]);
	for(i=0; i<x.length; i++){
		x[i].style.display="none";
	}

	var x=document.getElementsByClassName(actBtn);
	for( i=0; i<x.length; i++){
		x[i].style.backgroundColor="#232222";
		x[i].style.color="green";
	}

	actBtn=btncls;
	var views=document.getElementsByClassName(btnMap[actBtn]);
	for(i=0; i<views.length; i++){
		views[i].style.display="block";
	}
	
	var y=document.getElementsByClassName(actBtn);
	for( i=0; i<y.length; i++){
		y[i].style.backgroundColor="black";
		y[i].style.color="#0827d2";
	}
}
			