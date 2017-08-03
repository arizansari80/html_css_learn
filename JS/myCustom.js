/*My Slider*/

var myDivContainer=document.getElementById('mySliderDivContainer');
if(myDivContainer!=null){
	var containerJS=document.getElementById('mySliderContainer');
	var mySliderMember=document.getElementsByClassName('mySliderMember');
	var myNumeEle=mySliderMember.length;
	var masterWide=myDivContainer.clientWidth;

	var myContainer=$('#mySliderContainer');
	var k=setInterval(slide,5000);
	var z=-masterWide;
	var loop=0;
	var ctr=0;
	var sliderPointerMember=document.getElementsByClassName('sliderPointerMember');

	myDivContainer.style.height=masterWide/2+'px';
	containerJS.style.width=masterWide*myNumeEle+'px';

	for(i=0;i<myNumeEle;i++)
		mySliderMember[i].style.width=masterWide+'px';

	function slide(){
		str=z+"px";
		myContainer.animate({
			marginLeft:str
			// opacity:0.3
		},1000,function(){
			if(z==-masterWide*myNumeEle){
				myContainer.css("marginLeft","0px");
				z=-masterWide;
				loop=1;
			}
			if(!loop){
				sliderPointerMember[ctr].className="sliderPointerMember";
				sliderPointerMember[++ctr].className+=" sliderPointerActive";
			}
			else{
				sliderPointerMember[8].className="sliderPointerMember";
				sliderPointerMember[0].className+=" sliderPointerActive";
				ctr=0;
				loop=0;
			}
			// myContainer.animate({opacity:1},500);
		});
		z-=masterWide;
	}

	var myLeftButton=document.getElementById('myLeftButton');
	// var myrightButton=document.getElementById('myrightButton');

	myLeftButton.addEventListener('click',slideLeftSide);
	function slideLeftSide(){
		clearInterval(k);
		slide();
		k=setInterval(slide,5000);
	}

	myRightButton.addEventListener('click',slideRightSide);
	function slideRightSide(){
		clearInterval(k);
		z+=masterWide;
		z+=masterWide;
		str=z+"px";
		myContainer.animate({
			marginLeft:str
			// opacity:0.3
		},1000);
		sliderPointerMember[ctr].className="sliderPointerMember";
		sliderPointerMember[--ctr].className+=" sliderPointerActive";
		ctr--;
		k=setInterval(slide,5000);
	}

	var sliderPointerUl=document.getElementById('sliderPointerUl');
	sliderPointerUl.addEventListener('click',changeImage);

	function changeImage(e){
		clearInterval(k);
		toSettle=e.target.id.charCodeAt(0)-49;
		z=-toSettle*masterWide;
		strCI=z+"px";
		myContainer.css("marginLeft",strCI);
		sliderPointerMember[ctr].className="sliderPointerMember";
		sliderPointerMember[toSettle].className+=" sliderPointerActive";
		ctr=toSettle;
		ctr--;
		k=setInterval(slide,5000);
	}
}
/*My Slider End*/


/*Form Validity Check*/


//Empty Field Check

var compulsoryFill=document.getElementsByClassName('compulsory');
if(compulsoryFill!=null){
	for (var i = 0; i < compulsoryFill.length-1; i++)
		compulsoryFill[i].addEventListener('blur',emptyCheck);

	function emptyCheck(e){
		span=e.target.parentElement.getElementsByTagName('span');
		span[0].className="commonSpan";
		if(e.target.value=="")
			span[0].className+=" colorWarning";
		else
			span[0].className+=" myVisibilityHidden fine";
	}
}

//Only Number Check

var onlyNum=document.getElementsByClassName('onlyNumber');
if(onlyNum!=null){
	for (var i = 0; i < onlyNum.length; i++) {
		onlyNum[i].addEventListener('keypress',onlyNumCheck);
	}

	function onlyNumCheck(e){
		if(e.charCode<48||e.charCode>57)
			e.preventDefault();
	}
}

//Email Validator

var email=document.getElementById('email');
	if(email!=null){
		email.addEventListener('blur',emailValidator);

	function emailValidator(){
		var regEx=/^[a-z0-9]{1}[a-z0-9._]+@[a-z0-9]+\.[a-z]{2,4}$/;
		var span=email.parentElement.getElementsByClassName('commonSpan');
		span[0].className="commonSpan";	
		if(!regEx.test(email.value))
			span[0].className+=" colorWarning";
		else
			span[0].className+=" myVisibilityHidden fine";
	}
}
/* Form Validator End*/