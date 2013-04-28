<?php

if(isset($_POST['go'])) {
	//$server->execute('echo -ne "\n# Include SAS-Directory Settings\nInclude sas-dd.conf\n" > /etc/apache2/apache2.conf && touch /etc/apache2/sas-dd.conf');
}


?>
<script>
	$(function () {
    var scntDiv = $('#variable');
    var i = $('#option').size() + 1;

    $('#onemore').live('click', function () {
        $('<p><label>Direktive:</label><input type="text" id="option" name="option[]" class="text-long"><a href="#" id="away">Entfernen</a></p>').appendTo(scntDiv);
        i++;
        return false;
    });

    $('#away').live('click', function () {
        if (i > 2) {
            $(this).parents('p').remove();
            i--;
        }
        return false;
    });
});
</script>

<h3>&lt;Directory&gt;</h3>
<fieldset>
	Die meisten Einstellungen in der httpd.conf, die das Verhalten der veröffentlichten Website betreffen, sind Verzeichnisoptionen. &lt;Directory&gt; ... &lt;/Directory&gt; ist der wichtigste der entsprechenden Container.
</fieldset>
<div class="zweidrittel-box">
	<fieldset>
	<legend>Neu</legend>
	<form action="?p=apache&s=directorys" method="post">
		<p>
            <label>Kommentar:</label> 
            <input type="text" class="text-long" name="comment" placeholder="optional">
            <a href="#" class="tooltip3"><i class="icon-help-circled" style="font-size:15px"></i>
                <span><b>Info:</b><br>Wird als #Kommentar hinzugefügt über dem Container eingefügt.</span>
            </a>
        </p>
        <p>
            <label>Verzeichnispfad:</label> 
            <input type="text" class="text-long" name="path" placeholder="" required>
            <a href="#" class="tooltip3"><i class="icon-help-circled" style="font-size:15px"></i>
                <span><b>Info:</b><br></span>
            </a>
        </p>
        <div id="variable" style="margin-bottom:25px;">
        <p>
            <label>Direktive:</label> 
            <input type="text" class="text-long" name="option[]" placeholder="" id="option">
            <a href="#" class="tooltip3"><i class="icon-help-circled" style="font-size:15px"></i>
                <span><b>Info:</b><br>Wird als Kommentar hinzugefügt über dem Container eingefügt.</span>
            </a>
        </p>
        <a href="#" id="onemore" class="button black">weitere Direktive(n) hinzufügen</a>
        <br><br>
        </div>
        <input type="submit" value="Eintragen" class="button black">
	</form>
</fieldset>
</div>
<div class="zweidrittel-box lastbox">
</div>
<fieldset>
	<legend>Bearbeiten</legend>
</fieldset>
<fieldset>
	<legend>Löschen</legend>
</fieldset>
<div class="clearfix"></div>
<fieldset>
    <legend>Informationen</legend>
    <a href="http://httpd.apache.org/docs/2.2/de/mod/core.html#directory" target="_blank">Hier</a> finden Sie weitere Informationen
</fieldset>
