<?php
    if (!$server->isInstalled('mysql'))
    {
        header('Location: ?p=mysql&s=configure');
        die();
    }
?>
<h3> Hier ensteht die Seite "MySQL"</h3>
<fieldset>
    Diese Seite befindet sich in Entwicklung!
</fieldset>
