/* =======================================================================
Licensed under The Apache License
- Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
- https://github.com/pataga/SAS
- Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
- Author: Gabriel Wanzek
========================================================================== */

Mousetrap.bind("?", function(){ window.location.href = "?p=home&s=shortcuts"; });
Mousetrap.bind("1", function(){ window.location.href = "?p=home"; });
Mousetrap.bind("2", function(){ window.location.href = "?p=apache"; });
Mousetrap.bind("3", function(){ window.location.href = "?p=ftp"; });
Mousetrap.bind("4", function(){ window.location.href = "?p=mysql"; });
Mousetrap.bind("5", function(){ window.location.href = "?p=samba"; });
Mousetrap.bind("6", function(){ window.location.href = "?p=logs"; });
Mousetrap.bind("7", function(){ window.location.href = "?p=system"; });
Mousetrap.bind("8", function(){ window.location.href = "?p=tools"; });
Mousetrap.bind("9", function(){ window.location.href = "?p=webuser"; });
Mousetrap.bind("0", function(){ window.location.href = "?p=plugins"; });
Mousetrap.bind("g l o w", function(){
	$('fieldset').css('-webkit-animation', 'boxglow 2s infinite');
	$("#logo").css('-webkit-animation','glow 2s infinite'); 
	$("#logospan").css('-webkit-animation','glow 2s infinite'); 
});
Mousetrap.bind("l o l m o d e", function(){
	$('body').css('-webkit-animation', 'lolmode 1.5s linear 1');
});
Mousetrap.bind("s", function(){ 
	if (confirm('Möchten Sie den Server wechseln?')) {
	 window.location.href = "?server=change"; 
	};
});
Mousetrap.bind("q", function(){ 
	if (confirm('Möchten Sie sich ausloggen?')) {
	 window.location.href = "?user=logout"; 
	};
});