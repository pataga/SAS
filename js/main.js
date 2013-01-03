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
