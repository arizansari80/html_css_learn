var getRefBtnJS=document.getElementById('getRefBtn');

getRefBtnJS.addEventListener('click',getReference);

var ajaxHttp=new XMLHttpRequest();

function getReference(){
	var arrJS=new Array();
	var inputType=document.getElementById('formDiv').getElementsByTagName('input');
	var i,j;
	for (i = 0; i < inputType.length; i++){
		arrJS[i]=inputType[i].value;
		inputType[i].className=" commonDisabledInput";
	}
	var k=i;
	var selectType=document.getElementById('formDiv').getElementsByTagName('select');
	for (i = 0; i < selectType.length; i++){
		arrJS[k+i]=selectType[i].value;
		selectType[i].className=" commonDisabledInput";
	}

	ajaxHttp.onreadystatechange=function(){
		if(this.readyState==4&&this.status==200){
			var result=document.getElementById('queryResult');
			var myObj=JSON.parse(this.responseText);
			console.log(myObj);
			if(myObj.status.localeCompare("Successfull")==0){
				result.className="myShow bgSuccess colorSuccess";
				result.innerText="Account Request "+myObj.status+" & your Reference Number is "+myObj.refN+" Please Note Down your Reference Number for future Use It's Important";
				queryResult.style.lineHeight="35px";
			}
			else{
				if(myObj.refN!=0){
					var delRef=new XMLHttpRequest();

					delRef.onreadystatechange=function () {
						if(this.readyState==4&&this.status==200){
							console.log(this.responseText);
						}
					}
					delRef.open("POST","../PHP/AJAX/delReferenceNumber.php?q="+myObj.refN,true);
					delRef.send();
				}
				result.className="myShow bgWarning colorWarning";
				result.innerText="Service is temporary unavailabe or may be there is duplicate entry";
				queryResult.style.lineHeight="70px";
			}
			// console.log(this.responseText);
		}
	}

	var arrJSON=JSON.stringify(arrJS);

	// console.log(arrJSON);

	ajaxHttp.open("POST","../PHP/AJAX/referenceNumber.php?q="+arrJSON,true);
	ajaxHttp.send();
}