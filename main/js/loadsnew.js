loadnewcontent();
function loadnewcontent () {
	var xmlhttp=false;
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		try {
			xmlhttp = new XMLHttpRequest();
		} catch (e) {
			xmlhttp=false;
		}
	}
	if (!xmlhttp && window.createRequest) {
		try {
			xmlhttp = window.createRequest();
		} catch (e) {
			xmlhttp=false;
		}
	}	
	xmlhttp.open("POST", "index.php?p=home", true);
	xmlhttp.send(null);
	window.setTimeout("loadnewcontent()",2000);
}
