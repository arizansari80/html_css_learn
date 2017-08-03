var xhttpObj=new XMLHttpRequest();
var xhttpObj1=new XMLHttpRequest();

var receiveButtonJS=document.getElementById('receiveButton');
receiveButtonJS.addEventListener('click',getData);

function getData(){
	xhttpObj.open("GET","ajaxTEXT.txt",true);
	xhttpObj.send();
	xhttpObj.onreadystatechange=function(){
		if(this.readyState==4&&this.status==200){
			// document.getElementById('message').value=this.responseText;
			// document.getElementById('receiveInput').value=this.responseText;
			document.getElementById('ajaxData').innerHTML=this.responseText;
		}
	}
}

// var sendButtonJS=document.getElementById('sendButton');
// sendButtonJS.addEventListener('click',postData);

// function postData(){
// 	var sendD=document.getElementById('sendInput').value;
// 	xhttpObj1.open("GET","ajaxPHP.php",true);
// 	xhttpObj1.send();
// 	xhttpObj1.onreadystatechange=function(){
// 		if(this.readyState==4&&this.status==200){
// 			// document.getElementById('message').value=this.responseText;
// 			// document.getElementById('receiveInput').value=this.responseText;
// 			var myObj=JSON.parse(this.responseText);
// 			console.log(myObj.name);
// 		}
// 	}
// }
var sendButtonJS=document.getElementById('sendButton');
sendButtonJS.addEventListener('click',postData);

var xmlhttp = new XMLHttpRequest();

function postData(){
	xmlhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        var myObj = JSON.parse(this.responseText);
	        console.log(myObj);
	        document.getElementById("ajaxData").innerHTML = myObj.msg1;
	    }
	};
	var Obj={
		msg1:document.getElementById('sendInput').value,
		msg2:document.getElementById('message').value,
		msg3:document.getElementById('myNumber').value
	};
	var sendObj=JSON.stringify(Obj);
	xmlhttp.open("POST", "ajaxPHP.php?q="+sendObj, true);
	xmlhttp.send();
}