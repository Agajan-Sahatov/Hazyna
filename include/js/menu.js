var menus = document.getElementById('menus');
var menusStyle = menus.style;
var btn = document.getElementById('btn');
var btnStyle = btn.style;
var page_name = document.getElementById('pagename');
var page_nameStyle = page_name.style;
var n = 0;var q = 0;
btn.onclick = function(){
	if(menusStyle.display !== 'block'){
		menusStyle.display = 'block';
		n = 1;q = 0;
		page_nameStyle.opacity = '0';
	}
	else{
		menusStyle.display = 'none';
		page_nameStyle.opacity = '1';
		btnStyle.backgroundColor = 'white';
		n = 0;q = 0;
	}
}
items.onclick, selected.onclick = function(){
	menusStyle.display = 'none';
	btnStyle.border = '1px solid white';
	page_nameStyle.opacity = '1';
}
btn.onmouseover = function(){
	if( n == 0 ){ btnStyle.border = '1px solid black';}
	if( n == 1 && q == 1){btnStyle.backgroundColor = '#e9e9fc';}
}
btn.onmouseout = function(){
	if(n == 0){btnStyle.border = '1px solid white';}
	if( q == 1){btnStyle.border = '1px solid black';btnStyle.backgroundColor = 'white';}
	if(n == 1 && q == 0){q = 1;}
}
