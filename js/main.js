/* =======================================================================
Licensed under The Apache License
- Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
- https://github.com/pataga/SAS
- Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
- Author: Gabriel Wanzek
========================================================================== */

$(document).ready(function(){ 
        $("#sortable").tablesorter(); 	// Tabellensortierung
    } 
);
	
$(document).ready(function(){ 			// Spoiler
    $(".spoiler_div").hide();
	$(".show_hide").show();	
	$('.show_hide').click(function() {
		$(".spoiler_div").slideToggle();
	});

});

function checkDatabase() {
    if (document.getElementById('table'))
        document.getElementById('table').selectedIndex = 0; 
    document.getElementById('mysqlForm').submit();
}

function tabs(x) {
	var lis=document.getElementById("tabs_ui").childNodes;

	for(i=0;i<lis.length;i++)
	{
	  lis[i].className="";
	}
	x.className="selected";
	var res=document.getElementById("tabcontent");
	var tab=x.id;
	switch(tab)
	{
	    case "tab1":
	        res.innerHTML=document.getElementById("tab1content").innerHTML;
	        break; 
	    case "tab2":
	        res.innerHTML=document.getElementById("tab2content").innerHTML;
	        break;
	    case "tab3":
	        res.innerHTML=document.getElementById("tab3content").innerHTML;
	        break;
	    case "tab4":
	        res.innerHTML=document.getElementById("tab4content").innerHTML;
	        break;
	    case "tab5":
	        res.innerHTML=document.getElementById("tab5content").innerHTML;
	        break;
	    case "tab6":
	        res.innerHTML=document.getElementById("tab6content").innerHTML;
	        break;
	    default:
	        res.innerHTML=document.getElementById("tab1content").innerHTML;
	        break;

	}
}
