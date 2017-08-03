var ulist=document.getElementById('ulist');
ulist.addEventListener('click',show);

var init="first";

function show(e){
	var item=e.target;
	item=item.parentElement;
	item.className="active";
	var deact=document.getElementById(init);
	deact.className="";
	init=item.id;
}