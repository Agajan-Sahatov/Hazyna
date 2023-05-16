var request;
if (window.XMLHttpRequest) {
	request = new XMLHttpRequest();
} else {
	request = new ActiveXObject("Microsoft.XMLHTTP");
}
request.open('GET', '../include/json/friends_search_lang.json');
request.onreadystatechange = function() {
	if ((request.readyState===4) && (request.status===200)) {
		var lang = document.getElementById('lng').textContent;
		var items = JSON.parse(request.responseText);
		var item;
		for (var key in items){
			if(items[key].language === lang){
				item = items[key];
			}
		}
		for (var key in item){
			if(document.getElementById(key) !== null && item[key] !== ""){
				if(document.getElementById(key).getAttribute('type') === 'submit'){
					document.getElementById(key).setAttribute('value', item[key]);
				}
				else{
					document.getElementById(key).innerHTML = item[key];
				}
			}
		}
	}
}
request.send();