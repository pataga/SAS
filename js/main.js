/* =======================================================================
Licensed under The Apache License
- Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
- https://github.com/pataga/SAS
- Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt
- Author: Gabriel Wanzek
========================================================================== */

$(document).ready(function() 
    { 
        $("#sortable").tablesorter(); 	// Tabellensortierung
    } 
);
	
$(document).ready(function(){ 			// Spoiler mit jQuery
    $(".spoiler_div").hide();
	$(".show_hide").show();	
	$('.show_hide').click(function() {
		$(".spoiler_div").slideToggle();
	});

});

function tabs(x) {
	var lis=document.getElementById("tabs_ui").childNodes; //gets all the LI from the UL

	for(i=0;i<lis.length;i++)
	{
	  lis[i].className=""; //removes the classname from all the LI
	}
	x.className="selected"; //the clicked tab gets the classname selected
	var res=document.getElementById("tabcontent");  //the resource for the main tabcontent
	var tab=x.id;
	switch(tab) //this switch case replaces the tabcontent
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
