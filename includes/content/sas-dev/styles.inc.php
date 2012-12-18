<h1 class="normal">Content</h1>
<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
<hr>
<h3>Tooltip</h3>
<br>
<a href="#" class="tooltip">Dein Etwas
    <span><b>tooltip</b><br><br>Yeeeeey, jetzt siehst eine Beschreibung!</span>
</a>&nbsp;&nbsp;
<a href="#" class="tooltip2">Dein Etwas 2
    <span><b>tooltip2</b><br>Yeeeeey, jetzt siehst eine kleine Beschreibung, jedoch hat "Dein Etwas" keine Unterstriche</span>
</a>&nbsp;&nbsp;
<a href="#" class="tooltip3">Dein Etwas 3
    <span><b>tooltip3</b><br>Yeeeeey, jetzt siehst eine große Beschreibung!</span>
</a>
<hr>

<fieldset>
    <legend>&Uuml;berschriften</legend>
    <h1 class="normal">&Uuml;berschrift 1</h1>
    <h2>&Uuml;berschrift 2</h2>
    <h3>&Uuml;berschrift 3</h3>
    <h4>&Uuml;berschrift 4</h4>
    <h5>&Uuml;berschrift 5</h5>
    <h6>&Uuml;berschrift 6</h6>
</fieldset>
<hr>
<fieldset>
    <legend>Ladekringel (Grafik)</legend>
<p>
    <img src="img/load.gif" alt="Loading..">
</p>
</fieldset>
<hr>
<h3>(Lade-)Balken</h3>
<p>Durch die CSS-Class "stripes" werden animierte Streifen angezeigt.</p>
<div class="progress-bar blue">
    <span style="width: 25%"></span>
</div>
<code>
    &lt;div class="progress-bar blue"&gt;<br>
    &nbsp;&nbsp;&nbsp; &lt;span style="width:
    25%"&gt;&lt;/span&gt;<br>
    &lt;/div&gt;
</code>
<br>
<br>
<div class="progress-bar green stripes">
    <span style="width: 45%"></span>
</div>
<code>
    &lt;div class="progress-bar green stripes"&gt;<br>
    &nbsp;&nbsp;&nbsp; &lt;span style="width:
    45%"&gt;&lt;/span&gt;<br>
    &lt;/div&gt;
</code>
<br>
<br>
<div class="progress-bar orange stripes">
    <span style="width: 65%"></span>
</div>
<code>
    &lt;div class="progress-bar orange stripes"&gt;<br>
    &nbsp;&nbsp;&nbsp; &lt;span style="width:
    65%"&gt;&lt;/span&gt;<br>
    &lt;/div&gt;
</code>
<br>
<br>
<div class="progress-bar red stripes">
    <span style="width: 90%"></span>
</div>
<code>
    &lt;div class="progress-bar red stripes"&gt;<br>
    &nbsp;&nbsp;&nbsp; &lt;span style="width:
    90%"&gt;&lt;/span&gt;<br>
    &lt;/div&gt;
</code>
<br>
<hr>
<h3>Buttons</h3>
<p>sowohl für Links als auch für Submit's</p>
<a href="#" class="button white">Button</a> &nbsp;
<a href="#" class="button grey">Button</a> &nbsp;
<a href="#" class="button pink">Button</a> &nbsp;
<a href="#" class="button orange">Button</a> &nbsp;
<a href="#" class="button green">Button</a> &nbsp;
<a href="#" class="button blue">Button</a> &nbsp;
<a href="#" class="button purple">Button</a> &nbsp;
<a href="#" class="button teal">Button</a> &nbsp;
<a href="#" class="button darkblue">Button</a> &nbsp;
<a href="#" class="button black">Button</a> &nbsp;
<br><br>
<code class="fancy">
    &lt;a href="#" class="button black"&gt;Button&lt;/a&gt;
</code><br>
<p>Verfügbare Farben für Buttons: white, grey, pink, orange, green, blue, purple, teal, darkblue, black</p>
<hr>
<h3>Der Porno-Button</h3>
<a href="" class="pornobutton">Button</a>
<hr>
<h3>Tabelle</h3>
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
<hr>
<h3>Tabelle mit Sortierung</h3>
<table id="sortable" class="s"> 
    <thead> 
        <tr> 
            <th>ID</th>
            <th>Vorname</th> 
            <th>Nachname</th> 
            <th>E-Mail</th> 
            <th>Wert</th> 
            <th>Wert 2</th> 
        </tr> 
    </thead> 
    <tbody> 
        <tr> 
            <td>1</td>
            <td>Alex</td> 
            <td>Habuschja</td> 
            <td>alex.ha@gmail.com</td> 
            <td>50.0</td> 
            <td>http://www.jsmith.com</td> 
        </tr> 
        <tr> 
            <td>2</td>
            <td>Bernd</td> 
            <td>Müller</td> 
            <td>b.m@yahoo.com</td> 
            <td>51.02</td> 
            <td>http://www.frank.com</td> 
        </tr> 
        <tr> 
            <td>3</td>
            <td>Clown</td> 
            <td>Schmidt</td> 
            <td>c.schmidt@hotmail.com</td> 
            <td>45.20</td> 
            <td>http://www.jdoe.com</td> 
        </tr> 
        <tr> 
            <td>4</td>
            <td>David</td> 
            <td>Bolleknolle</td> 
            <td>david.bolle@earthlink.net</td> 
            <td>50.00</td> 
            <td>http://www.timconway.com</td> 
        </tr> 
        <tr> 
            <td>5</td>
            <td>Hermann</td> 
            <td>Wald</td> 
            <td>hr.wald@earthlink.net</td> 
            <td>50.2210</td> 
            <td>http://www.timconway.com</td> 
        </tr> 
        <tr> 
            <td>6</td>
            <td>Ulf</td> 
            <td>Knulf</td> 
            <td>Ulf.Knulf@earthlink.net</td> 
            <td>4540.00</td> 
            <td>http://www.timconway.com</td> 
        </tr> 
        <tr> 
            <td>7</td>
            <td>Friedel</td> 
            <td>Bolleknolle</td> 
            <td>Friedel.bolle@earthlink.net</td> 
            <td>90.00</td> 
            <td>http://www.timconway.com</td> 
        </tr> 
    </tbody> 
</table>
<hr>
<h3>Formular</h3>
<fieldset>
    <legend>Formularname</legend>
    <label>Sample label:</label><input type="text" class="text-long" />
    <br>
    <br>
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
        <br>
        <br>
        <select class="shadow">
            <option>Select one</option>
            <option>Select two</option>
            <option>Select tree</option>
            <option>Select one</option>
            <option>Select two</option>
            <option>Select tree</option>
        </select>
    </p>
    <p><label>Sample label:</label><textarea rows="1" cols="1"></textarea></p>
    <input type="submit" class="button black" value="Submit Query" />
</fieldset>
<h3>Box System</h3>
<div class="halbe-box">
    <span class="box-demo">halbe box</span>
</div>
<div class="halbe-box lastbox">
    <span class="box-demo">halbe box lastbox</span>
</div>
<div class="clearfix"></div>
<div class="drittel-box">
    <span class="box-demo">drittel box</span>
</div>
<div class="drittel-box">
    <span class="box-demo">drittel box</span>
</div>
<div class="drittel-box lastbox">
    <span class="box-demo">drittel box lastbox</span>
</div>
<div class="clearfix"></div>
<div class="drittel-box">
    <span class="box-demo">drittel box</span>
</div>
<div class="zweidrittel-box lastbox">
    <span class="box-demo">zweidrittel box lastbox</span>
</div>
<div class="clearfix"></div>
<div class="viertel-box">
    <span class="box-demo">viertel box</span>
</div>
<div class="viertel-box">
    <span class="box-demo">viertel box</span>
</div>
<div class="viertel-box">
    <span class="box-demo">viertel box </span>
</div>
<div class="viertel-box lastbox">
    <span class="box-demo">viertel box lastbox</span>
</div>
<div class="clearfix"></div>
<div class="dreiviertel-box">
    <span class="box-demo">dreiviertel box</span>
</div>
<div class="viertel-box lastbox">
    <span class="box-demo">viertel box lastbox</span>
</div>
<div class="clearfix"></div>
<div class="viertel-box">
    <span class="box-demo">viertel box</span>
</div>
<div class="viertel-box">
    <span class="box-demo">viertel box</span>
</div>
<div class="halbe-box lastbox">
    <span class="box-demo">halbe box lastbox</span>
</div>
<div class="clearfix"></div>
<div class="fuenftel-box">
    <span class="box-demo">fuenftel-box</span>
</div>
<div class="fuenftel-box">
    <span class="box-demo">fuenftel-box</span>
</div>
<div class="fuenftel-box">
    <span class="box-demo">fuenftel-box</span>
</div>
<div class="fuenftel-box">
    <span class="box-demo">fuenftel-box</span>
</div>
<div class="fuenftel-box lastbox">
    <span class="box-demo">fuenftel-box lastbox</span>
</div>
<div class="clearfix"></div>
<div class="zweifuenftel-box">
    <span class="box-demo">zweifuenftel-box</span>
</div>
<div class="dreifuenftel-box lastbox">
    <span class="box-demo">dreifuenftel-box lastbox</span>
</div>
<div class="clearfix"></div>
<div class="fuenftel-box">
    <span class="box-demo">fuenftel-box</span>
</div>
<div class="vierfuenftel-box lastbox">
    <span class="box-demo">vierfuenftel-box lastbox</span>
</div>
<div class="clearfix"></div>
<hr>
<h3>Meldungen</h3>
<span class="info">Das ist eine "info"-Meldung</span>
<br>
<span class="success">Das ist eine "success"-Meldung</span>
<br>
<span class="alert">Das ist eine "alert"-Meldung</span>
<br>
<span class="error">Das ist eine "error"-Meldung</span>
<hr>
<h3>Statusinformationen</h3>
<span class='aktiv'>installiert</span>
&nbsp;&nbsp;
<span class='inaktiv'>nicht installiert</span>
&nbsp;&nbsp;
<span class="notaviable">nicht verf&uuml;gbar</span>
<hr>