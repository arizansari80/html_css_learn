var sort="DESC";
var author="";
var title="";
var publisher="";
var isbn="";

function clockTime(){
			var x=Date();
			var y=x.substr(0,15);
				x=x.substr(16,8);
		document.getElementById("tm").innerHTML=x;
		document.getElementById("dat").innerHTML=y;
	} setInterval(clockTime,1000);
		
function reset(){
		author="";
		title="";
		publisher="";
		isbn="";
		document.getElementById("display").innerHTML = "<legend><b>SEARCH RESULTS</b></legend>";
		var x=document.forms["filter"];
		var i;
		for( i=1; i<x.length; i+=1){
			x[i].value="";
		}
	}
		
function check(){
		author="";
		title="";
		publisher="";
		isbn="";
		document.getElementById("display").innerHTML = "<legend><b>SEARCH RESULTS</b></legend>";
		var x=document.forms["filter"];
		var i;
		for( i=0; i<x.length-2; i++){
			x[i].checked=true;
			i++;
			x[i].disabled=false;
			x[i].style.backgroundColor="white";
		}
			x[i].checked=false;
			i++;
			x[i].disabled=true;
			x["isb"].style.backgroundColor="gray";
			x["isb"].value="";
	}

function uncheck(){
		author="";
		title="";
		publisher="";
		isbn="";
		document.getElementById("display").innerHTML = "<legend><b>SEARCH RESULTS</b></legend>";
		var x=document.forms["filter"];
		var i;
		for( i=0; i<x.length-2; i++){
			x[i].checked=false;
			i++;
			x[i].disabled=true;
			x[i].style.backgroundColor="gray";
			x[i].value="";
		}
			x["isb"].disabled=false;
			x["isb"].style.backgroundColor="white";
	}

var cleanup=function(elem){
		elem.value=elem.value.toUpperCase();
		elem.value=elem.value.replace(/^\s/,"");
		elem.value=elem.value.replace(/\s{2,}/g," ");

		if(elem.name == 'ttl'){
			title=elem.value;
		}
		else if(elem.name == 'atr'){
			author=elem.value;
		}
		else if(elem.name == 'pbl'){
			publisher=elem.value;
		}
		else {
			isbn=elem.value;
		}
}

function order(){
	if(sort == 'DESC') sort='ASC';
	else sort='DESC';
}


