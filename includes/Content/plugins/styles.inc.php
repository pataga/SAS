<?php
/**
 * Licensed under The Apache License
 *
 * @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
 * @link https://github.com/pataga/SAS
 * @since SAS v1.0.0
 * @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
 * @author Gabriel Wanzek
 *
 */
?><h1 class="normal">Dev: CSS-Info</h1>
<span class="error">Diese Seite ist unvollständig und wird vorerst nicht aktualisiert.<br>Für Entwickler ist die Datei "css/main.css" jedoch mit einem Inhaltsverzeichnis versehen.</span>
<hr>
<p><b>Tipp:</b> Die "Element untersuchen" Funktion von Firefox kann hier hilfreich sein.</p>
<h3>Inhalt:</h3>
<ol>
    <li><a href="#tt">Tooltips</a></li>
    <li><a href="#hd">Überschrifen</a></li>
    <li><a href="#co">Code/Ausgabefelder</a></li>
    <li><a href="#gr">Grafiken</a></li>
    <li><a href="#lb">Ladebalken</a></li>
    <li><a href="#bu">Buttons</a></li>
    <li><a href="#tb">Tabellen</a></li>
    <li><a href="#fo">Formular</a></li>
    <li><a href="#bx">Box-System</a></li>
    <li><a href="#md">Meldungen</a></li>
    <li><a href="#si">Statusinformationen</a></li>
    <li><a href="#sp">Spoiler</a></li>
    <li><a href="#tab">Tabs</a></li>
    <li><a href="#icons">Icons</a></li>
</ol>

<hr>
<!--
   =========================== TOOLTIPS ===========================
-->
<h3 id="tt">Tooltips</h3>
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
<!--
   =========================== ÜBERSCHRIFTEN ===========================
-->
<fieldset>
    <legend id="hd">&Uuml;berschriften</legend>
    <h1 class="normal">&Uuml;berschrift 1</h1>
    <h2>&Uuml;berschrift 2</h2>
    <h3>&Uuml;berschrift 3</h3>
    <h4>&Uuml;berschrift 4</h4>
    <h5>&Uuml;berschrift 5</h5>
    <h6>&Uuml;berschrift 6</h6>
</fieldset>
<hr>
<!--
   =========================== CODE / AUSGABEFELDER ===========================
-->
<fieldset>
    <legend id="co">Code/Ausgabefelder</legend>
    <br>
    code:<br>
    <code>0% [Warten auf Kopfzeilen][Verbindung mit extras.ubuntu.com (91.189.88.33)]</code>
    <br><br>
    code.simple:<br>
    <code class="simple">0% [Warten auf Kopfzeilen][Verbindung mit extras.ubuntu.com (91.189.88.33)] </code>
    <br><br>
    code.fancy:<br><br>
    <code class="fancy">0% [Warten auf Kopfzeilen][Verbindung mit extras.ubuntu.com (91.189.88.33)] </code>
    <hr>
    pre:<br>
    <pre>gabriel@papaya:/$ ll /var/www/
insgesamt 24
drwxrwxrwx  6 root    root    4096 Dez 29 18:18 ./
drwxr-xr-x 15 root    root    4096 Jan  1 22:53 ../
drwxrwxrwx 15 root    root    4096 Nov 23 00:05 backup-pc/
drwxrwxrwx  9 root    root    4096 Dez 27 01:30 gab/
lrwxrwxrwx  1 root    root      22 Nov 26 16:05 phpsysinfo -> /usr/share/phpsysinfo//
drwxr-xr-x  9 gabriel gabriel 4096 Dez 19 11:29 SAS/
drwxrwxrwx  8 root    root    4096 Jan 18  2011 sqlbuddy/
    </pre>
    <div class="clearfix"></div>
    pre.simple:<br>
    <pre class="simple">gabriel@papaya:/$ ll /var/www/
insgesamt 24
drwxrwxrwx  6 root    root    4096 Dez 29 18:18 ./
drwxr-xr-x 15 root    root    4096 Jan  1 22:53 ../
drwxrwxrwx 15 root    root    4096 Nov 23 00:05 backup-pc/
drwxrwxrwx  9 root    root    4096 Dez 27 01:30 gab/
lrwxrwxrwx  1 root    root      22 Nov 26 16:05 phpsysinfo -> /usr/share/phpsysinfo//
drwxr-xr-x  9 gabriel gabriel 4096 Dez 19 11:29 SAS/
drwxrwxrwx  8 root    root    4096 Jan 18  2011 sqlbuddy/
    </pre>

</fieldset>
<hr>
<!--
   =========================== GRAFIKEN ===========================
-->
<fieldset>
    <legend id="gr">Grafiken</legend>
    <p>
        <img src="img/load.gif" alt="Loading..">
    </p>
</fieldset>
<hr>
<!--
   =========================== LADEBALKEN ===========================
-->
<h3 id="lb">Ladebalken</h3>
<fieldset>
    <h5>&lt;meter&gt;-tag</h5>

    <p>Kann auch mit <code>style="width: 100px; height: 20px;"</code> angepasst werden.</p>
    <li>
        <meter value="0"></meter>
    </li>
    <li>
        <meter value="1"></meter>
    </li>
    <li>
        <meter min="30" max="40" value="35"></meter>
    </li>
    <li>
        <meter min="0" max="250" low="20" high="200" value="40"></meter>
    </li>
    <li>
        <meter min="100" max="1000" low="200" high="800" value="900"></meter>
    </li>
    <li>
        <meter low="70" high="80" max="100" value="90"></meter>
    </li>
    <p><b>Wichtig! </b>Für Browser die diese Tags noch nicht unterstützen, schreibt man zwischen die Tags einen
        Alternativtext.</p>
</fieldset>
<fieldset>
    <h5>&lt;progress&gt;-tag</h5>

    <p>Kann mit CSS nicht verändern werden.</p>
    <li>
        <progress></progress>
    </li>
    <li>
        <progress max="10" value="0"></progress>
    </li>
    <li>
        <progress max="10" value="10"></progress>
    </li>
    <li>
        <progress max="100" value="57"></progress>
    </li>
    <p><b>Wichtig! </b>Für Browser die diese Tags noch nicht unterstützen, schreibt man zwischen die Tags einen
        Alternativtext.</p>
</fieldset>
<!--<p>Durch die CSS-Class "stripes" werden animierte Streifen angezeigt.</p>
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
<hr>-->
<!--
   =========================== BUTTONS ===========================
-->
<h3 id="bu">Buttons</h3>

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
<!--
   =========================== TABELLEN ===========================
-->
<h3 id="tb">Tabellen</h3>
<h5>Normale Tabelle</h5>
<table cellpadding="0" cellspacing="0">
    <tr>
        <td>Vivamus rutrum nibh in felis tristique vulputate</td>
        <td class="action"><a href="#" class="view">View</a><a href="#" class="edit">Edit</a><a href="#" class="delete">Delete</a>
        </td>
    </tr>
    <tr class="odd">
        <td>Duis adipiscing lorem iaculis nunc</td>
        <td class="action"><a href="#" class="view">View</a><a href="#" class="edit">Edit</a><a href="#" class="delete">Delete</a>
        </td>
    </tr>
    <tr>
        <td>Donec sit amet nisi ac magna varius tempus</td>
        <td class="action"><a href="#" class="view">View</a><a href="#" class="edit">Edit</a><a href="#" class="delete">Delete</a>
        </td>
    </tr>
    <tr class="odd">
        <td>Duis ultricies laoreet felis</td>
        <td class="action"><a href="#" class="view">View</a><a href="#" class="edit">Edit</a><a href="#" class="delete">Delete</a>
        </td>
    </tr>
    <tr>
        <td>Vivamus rutrum nibh in felis tristique vulputate</td>
        <td class="action"><a href="#" class="view">View</a><a href="#" class="edit">Edit</a><a href="#" class="delete">Delete</a>
        </td>
    </tr>
</table>
<hr>
<h5>Tabelle mit Sortierung</h5>
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
<!--
   =========================== FORMULARE ===========================
-->
<h3 id="fo">Formulare</h3>
<fieldset>
    <legend>Formularname</legend>
    <label>Sample label:</label><input type="text" class="text-long"/>
    <br>
    <br>

    <p><label>Sample label:</label><input type="text" class="text-medium"/><input type="text" class="text-small"/><input
            type="text" class="text-small"/></p>

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
        <br><br>
        <i>Mehrere mit Strg/Ctrl auswählen</i><br>
        <select size="5" class="multi" multiple>
            <option>Select items here here</option>
            <option>Select items here here</option>
            <option>Select items here here</option>
            <option>Select items here here</option>
            <option>Select items here here</option>
            <option>Select items here here</option>
            <option>Select items here here</option>
        </select>
    </p>
    <p><label>Sample label:</label><textarea rows="1" cols="1"></textarea></p>
    <input type="submit" class="button black" value="Submit Query"/>
</fieldset>
<!--
   =========================== BOX-SYSTEM ===========================
-->
<h3 id="bx">Box System</h3>

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
<!--
   =========================== MELDUNGEN ===========================
-->
<h3 id="md">Meldungen</h3>
<span class="info">Das ist eine "info"-Meldung</span>
<br>
<span class="success">Das ist eine "success"-Meldung</span>
<br>
<span class="alert">Das ist eine "alert"-Meldung</span>
<br>
<span class="error">Das ist eine "error"-Meldung</span>
<hr>
<!--
   =========================== STATUSINFORMATIONEN ===========================
-->
<h3 id="si">Statusinformationen</h3>
<span class='aktiv'>installiert</span>
&nbsp;&nbsp;
<span class='inaktiv'>nicht installiert</span>
&nbsp;&nbsp;
<span class="notaviable">nicht verf&uuml;gbar</span>
<hr>
<!--
   =========================== SPOILER ===========================
-->
<h3 id="sp">Spoiler (jQuery)</h3>
<span class="show_hide">Zeig mir mehr!</span> <!-- Öffnen und Schließen -->
<br>

<div class="spoiler_div"> <!-- Der Content der geöffnet/geschlossen wird -->
    <h4>Dein Inhalt</h4>

    <p>Hier kann man ganz normal den Seiteninhalt einbetten.</p>

    <p><b>Achtung:</b> Vorerst nur ein Spoiler pro Seite verwenden.</p>
    <hr>
    <h5>Code:</h5>
    <pre class="simple">&lt;span class="show_hide"&gt;Zeigen/Verstecken&lt;/span&gt;
    &lt;br&gt;
    &lt;div class="spoiler_div"&gt; <br>
        Dein Spoiler-Inhalt!<br>
    &lt;/div&gt;</pre>
    <hr>
    <h5>Bei Konsolenausgaben:</h5>
    <pre class="simple">&lt;span class="show_hide"&gt;Zeigen/Verstecken&lt;/span&gt;
    &lt;br&gt;
    &lt;div class="spoiler_div console"&gt; <br>
        Dein Spoiler-Inhalt!<br>
    &lt;/div&gt;</pre>
    <hr>
    <p>Der "Schließen"-Button ist optional!</p>
    <span class="show_hide">Schließen</span>
</div>
<hr>
<!--
   =========================== TABS ===========================
-->
<h3 id="tab">Tabs</h3>
<p>Max. Tabs: 6 Stück</p>
<div class="tabnav" >
    <ul class="tabl" id="tabs_ui">
        <li id="tab1" class="selected" onclick="tabs(this);">Tab 1</li>
        <li id="tab2" onclick="tabs(this);">Tab 2</li>
        <li id="tab3"  onclick="tabs(this);">Tab 3</li>
    </ul>
    <div id="tabcontent">
        <h5>Tab 1!</h5>
        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
    </div>
</div> 
<div id="tab1content" style="display:none;">
    <h5>Tab 1!</h5>
    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
</div>
<div id="tab2content" style="display:none;">
    <h5>Tab Nummero 2!</h5>
    <p>At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
</div>
<div id="tab3content" style="display:none;">
    <h5>Tab Nummer 3!</h5>
    <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla </p>
</div>
<hr>
<!--
   =========================== ICONS ===========================
-->
<h3 id="icons">Icons</h3>
<b><i class="icon-info"></i> Verwendung:</b>
<pre>
<?=htmlentities('<i class="icon-info"></i>')?>
</pre>
<h4>Verfügbare Icons</h4>
<div style="height:330px;width:700px; overflow-x:scroll; overflow-y: hidden;box-shadow:0 0 5px #ccc;"> 
<img src="css/iconhelp.png" alt="">
</div>
