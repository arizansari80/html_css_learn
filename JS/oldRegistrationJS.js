/*var activateSendMail=1;
var sendMailBtn=document.getElementById('sendEmail');
sendEmail.disabled=true;
sendEmail.style.background="grey";*/

/*Number Ckeck In Number Type*/
var numValid={
	day:document.getElementById('day'),
	year:document.getElementById('year'),
	pincode:document.getElementById('pincode'),
	mobile:document.getElementById('mobile'),
	accountNumber:document.getElementById('accountNumber')
};

numValid.accountNumber.addEventListener('keypress',number_check);
numValid.day.addEventListener('keypress',number_check);
numValid.year.addEventListener('keypress',number_check);
numValid.pincode.addEventListener('keypress',number_check);
numValid.mobile.addEventListener('keypress',number_check);

function number_check(e){
	var k=e.charCode;
	if(k<48||k>58)
		e.preventDefault();
}


//Email Verifier
var email=document.getElementById('email');
email.addEventListener('blur',verify_email);

function verify_email(e){
	emailSpan=document.getElementById('emailSpan');
	var reEmail=/^[a-z0-9]{1}[a-z0-9._]+@[a-z]+\.[a-z]{2,4}$/;
	if(!reEmail.test(email.value))
		emailSpan.style.display="block";
	else{
		emailSpan.style.display="none";
		activateSendMail++;
	}
}


//month Slide
var monthSec=document.getElementById('month_sec');
monthSec.addEventListener('click',slideUpon);
var z=0;

function slideUpon(e){
	var s=$('#month_ul');
	var monthSpan=document.getElementById('monthSpan');
	if(z%2==0)
		monthSpan.innerText='-';
	else
		monthSpan.innerText='+';
	z++;
	s.slideToggle();
}

var upMonth=document.getElementById('month_ul');
upMonth.addEventListener('click',updateMonth)

function updateMonth(e){
	var month=e.target.innerText;
	var updateM=document.getElementById('nameMonth');
	updateM.innerText=month;
}


//Name Details Not Empty
var nameDetails=document.getElementById('name_details');
var nameDetail={
	nameArr:nameDetails.getElementsByTagName('input')
};

nameDetail.nameArr[0].addEventListener('blur',emptyCheck);
nameDetail.nameArr[2].addEventListener('blur',emptyCheck);
var spanEle=document.getElementById('nameSpan');

function emptyCheck(e){
	if(nameDetail.nameArr[0].value==""||nameDetail.nameArr[2].value=="")
		spanEle.style.display="block";
	else
		spanEle.style.display="none";
}

//Mobile Number Empty Check
numValid.mobile.addEventListener('blur',emptyCheckMob);
numValid.accountNumber.addEventListener('blur',emptyCheckAcc);

function emptyCheckMob(){
	var mobileSpan=document.getElementById('mobileSpan');
	if(numValid.mobile.value=="")
		mobileSpan.style.display="block";
	else{
		mobileSpan.style.display="none";
		activateSendMail++;	
	}
}

function emptyCheckAcc(){
	var accountSpan=document.getElementById('accountSpan');
	if(numValid.accountNumber.value=="")
		accountSpan.style.display="block";
	else{
		accountSpan.style.display="none";
		activateSendMail++;	
	}
}

var secQuesCall=document.getElementById('securityQues');
secQuesCall.addEventListener('click',securityQT);

function securityQT(){
	var se=$('#securityQuesUl');
	se.slideToggle();
}

var preTar;
var secQuesUl=document.getElementById('securityQuesUl');
secQuesUl.addEventListener('click',updateQues);
var disableLi;

function updateQues(e){
	var textQues=e.target.innerText;
	preTar=e.target.getAttribute('class');
	disableLi=document.getElementsByClassName(preTar);
	disableLi[1].className+=" disabled";
	var updateQ=document.getElementById('securityQuesSpan');
	updateQ.innerText=textQues;
	var ans=document.getElementById('answerSecurityQues');
	ans.style.display="block";
}

var secQuesCall1=document.getElementById('securityQues1');
secQuesCall1.addEventListener('click',securityQT1);

function securityQT1(){
	var se1=$('#securityQuesUl1');
	se1.slideToggle();
}

var secQuesUl1=document.getElementById('securityQuesUl1');
secQuesUl1.addEventListener('click',updateQues1);

function updateQues1(e){
	var textQues1=e.target.innerText;
	var updateQ1=document.getElementById('securityQuesSpan1');
	updateQ1.innerText=textQues1;
	var ans1=document.getElementById('answerSecurityQues1');
	ans1.style.display="block";
}