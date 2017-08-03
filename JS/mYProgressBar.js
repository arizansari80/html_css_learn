var mYButton=document.getElementById('myButton');
mYButton.addEventListener('click',mYProgressBar);

function mYProgressBar(){
	var mYProgress=document.getElementById('mYProgressBar');
	//console.log(mYProgress.style.width);
	var i=0;
	var myId=setInterval(frame,1000);
	function frame(){
		if(i>=100)
			clearInterval(myId);
		else{
			i++;
			mYProgress.style.width=i+"%";
			mYProgress.innerText=i+"%";
		}
	}
}

function sleep(delay) {
    var start = new Date().getTime();
    while (new Date().getTime() < start + delay);
}