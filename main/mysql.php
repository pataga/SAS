<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAS - Server Admin System</title>

<!-- CSS -->
<link href="style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="style/css/ie7.css" /><![endif]-->

<!-- JavaScripts-->
<script type="text/javascript" src="style/js/jquery.js"></script>
<script type="text/javascript" src="style/js/jNice.js"></script>
</head>

<body>
	<div id="wrapper">
    	<h1>Server <span>Admin</span> System</h1>
        
        <!-- You can name the links with lowercase, they will be transformed to uppercase by CSS, we prefered to name them with uppercase to have the same effect with disabled stylesheet -->
        <ul id="mainNav">
        	<li><a href="index.html">START</a></li> <!-- Use the "active" class for the active menu item  -->
        	<li><a href="apache.html">APACHE</a></li>
			<li><a href="postfix.html">POSTFIX</a></li>
        	<li><a href="ftp.html">FTP</a></li>
        	<li><a href="mysql.html" class="active">MYSQL</a></li>
			<li><a href="samba.html">SAMBA</a></li>
			<li><a href="management.html">MANAGEMENT</a></li>
			<li><a href="webuser.html">WEBUSER</a></li>	
			<li><a href="tools.html">SERVERTOOLS</a></li>			
        	<li class="logout"><a href="#">LOGOUT</a></li>
        </ul>
        <!-- // #end mainNav -->
        
        <div id="containerHolder">
			<div id="container">
        		<div id="sidebar">
                	<ul class="sideNav">
                    	<li><a href="#" class="active">MySQL-Server &Uuml;bersicht</a></li>
                    	<li><a href="#">Konfiguration</a></li>
						<li><a href="#">Steuerung</a></li>
                    	<li><a href="#">Datenbanken</a></li>
						<li><a href="#">Benutzer</a></li>
						<li><a href="#">Im-/Export</a></li>
						<li><a href="#">Statistiken</a></li>
						<li><a href="#">SQL Befehle ausf&uuml;hren</a></li>
						<li><a href="#">phpMyAdmin</a></li>
                    	
                    </ul>
                    <!-- // .sideNav -->
                </div>    
                <!-- // #sidebar -->
                
                <!-- h2 stays for breadcrumbs -->
                <h2><a href="#">Dashboard</a> &raquo; <a href="#" class="active">Print resources</a></h2>
                
                <div id="main">
                	<form action="" class="jNice">
					<h3>Sample section</h3>
                    	<table cellpadding="0" cellspacing="0">
							<tr>
                                <td>Vivamus rutrum nibh in felis tristique vulputate</td>
                                <td class="action"><a href="#" class="view">View</a><a href="#" class="edit">Edit</a><a href="#" class="delete">Delete</a></td>
                            </tr>                        
							<tr class="odd">
                                <td>Duis adipiscing lorem iaculis nunc</td>
                                <td class="action"><a href="#" class="view">View</a><a href="#" class="edit">Edit</a><a href="#" class="delete">Delete</a></td>
                            </tr>                        
							<tr>
                                <td>Donec sit amet nisi ac magna varius tempus</td>
                                <td class="action"><a href="#" class="view">View</a><a href="#" class="edit">Edit</a><a href="#" class="delete">Delete</a></td>
                            </tr>                        
							<tr class="odd">
                                <td>Duis ultricies laoreet felis</td>
                                <td class="action"><a href="#" class="view">View</a><a href="#" class="edit">Edit</a><a href="#" class="delete">Delete</a></td>
                            </tr>                        
							<tr>
                                <td>Vivamus rutrum nibh in felis tristique vulputate</td>
                                <td class="action"><a href="#" class="view">View</a><a href="#" class="edit">Edit</a><a href="#" class="delete">Delete</a></td>
                            </tr>                        
                        </table>
					<h3>Another section</h3>
                    	<fieldset>
                        	<p><label>Sample label:</label><input type="text" class="text-long" /></p>
                        	<p><label>Sample label:</label><input type="text" class="text-medium" /><input type="text" class="text-small" /><input type="text" class="text-small" /></p>
                            <p><label>Sample label:</label>
                            <select>
                            	<option>Select one</option>
                            	<option>Select two</option>
                            	<option>Select tree</option>
                            	<option>Select one</option>
                            	<option>Select two</option>
                            	<option>Select tree</option>
                            </select>
                            </p>
                        	<p><label>Sample label:</label><textarea rows="1" cols="1"></textarea></p>
                            <input type="submit" value="Submit Query" />
                        </fieldset>
                    </form>
                </div>
                <!-- // #main -->
                
                <div class="clear"></div>
            </div>
            <!-- // #container -->
        </div>	
        <!-- // #containerHolder -->
        
        <center><p id="footer">SAS - Server Admin System | Klasse: 2BKI2 | <a href="#">Patrick Farnkopf</a>, <a href="#">Tanja Weiser</a> &amp; <a href="http://mangopix.de">Gabriel Wanzek</a></p></center>
    </div>
    <!-- // #wrapper -->
</body>
</html>


