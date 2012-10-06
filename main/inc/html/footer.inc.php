<div class="clear"></div>
            </div>
            <!-- // #container -->
        </div>	
        <!-- // #containerHolder -->
        
        <center><p id="footer">SAS - Server Admin System | Klasse: 2BKI2 | <a href="#">Patrick Farnkopf</a>, <a href="#">Tanja Weiser</a> &amp; <a href="http://mangopix.de">Gabriel Wanzek</a><br><br>
		<?php 
		
		$file = $_SERVER["SCRIPT_NAME"];
		$break = Explode('/', $file);
		$pfile = $break[count($break) - 1];
		echo $pfile;  
		
		?>

	</p><br></center>
		</div>
		<!-- // #wrapper -->
		<!--
		echo basename(__FILE__)
		-->
		
	</body>
	</html>