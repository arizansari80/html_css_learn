//Button Activator Fuction check it

//triggerIt();

/*This facility is to activate the button only if all the compulsory
field are filled other wise the button will be deactivated*/


//Empty Field Check

//Button Activator

var key=0;

var sendMailBtn=document.getElementById('sendMailBtn');
sendMailBtn.disabled=true;
sendMailBtn.style.cursor="not-allowed";
sendMailBtn.style.background="grey";

var toEnable;
var spanCheck=document.getElementsByClassName('commonSpan');

function enableCheck(){
	var n=spanCheck.length;
	var ctr=0;
	for(i=0;i<n;i++)
		if(spanCheck[i].className.indexOf("myShow")==-1)
			ctr++;
	if(ctr==n){
		sendMailBtn.disabled=false;
		sendMailBtn.style.cursor="";
		sendMailBtn.style.background="";
		clearInterval(toEnable);
	}
}

function triggerIt(){
	if(++key==11){
		toEnable=setInterval(enableCheck,1000);
	}
	else if(key==12){
		toEnable=setInterval(enableCheck,1000);	
		sendMailBtn.disabled=true;
		sendMailBtn.style.cursor="not-allowed";
		sendMailBtn.style.background="#grey";
		key--;
	}
}