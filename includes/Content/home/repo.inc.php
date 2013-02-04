<h3>SAS-Repository</h3>
<p>Sie werden in <span id="sec_time">5</span> Sekunden auf eine externe Seite weitergeleitet, sollte die Weiterleitung nicht erfolgen, klicken Sie bitte <a href="https://github.com/pataga/SAS/">hier</a>.</p>

<script>
	var sec = 5;
	var url = "https://github.com/pataga/SAS/";
	var SetInt = window.setInterval("umleitung()", 1000);

		function umleitung(){
			sec--;
			document.getElementById('sec_time').innerHTML=sec;
			if(sec==0){
				window.clearInterval(SetInt);
				window.location = url;
			}
		}
</script>