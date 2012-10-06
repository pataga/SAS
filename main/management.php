<?php include 'inc/html/top.inc.php'; ?>
<!-- // #end mainNav -->

<div id="containerHolder">
    <div id="container">
        <div id="sidebar">
            <ul class="sideNav">
                <li><a href="#" class="active">Server&uuml;bersicht</a></li>
                <li><a href="#">Neuen Server hinzuf&uuml;gen</a></li>
                <li><a href="#">Stammdaten &auml;ndern</a></li>
                <li><a href="#">Starten</a></li>
                <li><a href="#">Neustarten</a></li>
                <li><a href="#">Herunterfahren</a></li>
                <li><a href="#">Zur&uuml;cksetzen</a></li>
                <li><a href="#">Image aufspielen</a></li>
                <li><a href="#">Grundinstallation</a></li>
                <li><a style="color: rgb(255, 0, 0);" href="#">Selbstzerst&ouml;rung</a></li>


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
        <?php include 'inc/html/footer.inc.php'; ?>
