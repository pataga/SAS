<?php
if (isset($_POST['install'])) {
  $server->execute('apt-get install samba -yf');
  $smbconf = "
[global]
   workgroup = WORKGROUP
   server string = %h server (Samba, Ubuntu)
   wins support = no
   dns proxy = no
   log file = /var/log/samba/log.%m
   max log size = 1000
   syslog only = no
   syslog = 0
   panic action = /usr/share/samba/panic-action %d
   encrypt passwords = true
   passdb backend = tdbsam
   obey pam restrictions = yes
   unix password sync = yes
   passwd program = /usr/bin/passwd %u
   passwd chat = *Enter\snew\s*\spassword:* %n\n *Retype\snew\s*\spassword:* %n\n *password\supdated\ssuccessfully* .
   pam password change = yes
   map to guest = bad user

[printers]
   comment = All Printers
   browseable = no
   path = /var/spool/samba
   printable = yes
   guest ok = no
   read only = yes
   create mask = 0700

[print$]
   comment = Printer Drivers
   path = /var/lib/samba/printers
   browseable = yes
   read only = yes
   guest ok = no

  ";

  $ssh->execute('echo '.$smbconf.' > /etc/samba/smb.conf');
  $mysql->Query("UPDATE sas_server_data SET samba=1 WHERE id = ".$session->GetServerID());
}

if (!$server->isInstalled('samba')) {
?>
<fieldset>
    <h5>Samba wurde noch nicht von SAS eingerichtet. Bitte klicken Sie auf "Samba Installation" um Samba in SAS verf&uuml;gbar zu machen.</h5>
    <form action="?p=samba&s=install" method="post">
        <input type="submit" name="install" value="Samba Installation" class="button black">
    </form>
</fieldset>
<?}
else {
?>
<fieldset>
    <h5>Samba wurde erfolgreich installiert.</h5>
</fieldset>
<?
}
?>
