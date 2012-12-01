![logo2]

---

**Projektarbeit von Patrick Farnkopf, Tanja Weiser und Gabriel Wanzek** *(PaTaGa)* **| 2BKI2 | WvS² Mannheim**

---


###Verzeichnisinhalte:

* **daemon:** alternative verbindung über java-daemon (anstatt SSH2)
* **dev-tmp:** Dateien (Skripte u.ähn.) die in SAS eingebettet werden können sowie Backups älterer Versionen und Daten
* **main:** Aktuellste Version des Gesamtprojekts. Inkl. das neue CSS3 Template von SAS (Eigenentwicklung)
* **module:** Teilentwicklung von Modulen
* **nbproject:** Nicht relevante Dateien, (Netbeans-Projekt-Daten)
* **sql:** Benötigte Daten aus der MySQL-Datenbank
* **tools:** Zusätzliche externe Programme/Tools für SAS
           
---
###Online Demo:

> **[http://46.38.238.216/SAS][2]**

------
###Default Web Access:
~~~
User:      admin
Passwort:  geheim
~~~
           
---
###Dokumentation:

> **[SAS Dokumentation (Google Documents)][1]**
>
> **[SAS Notizbuch (Google Documents)][4]**

---
###Präsentation:

> **[SAS Präsentation "Projektvorstellung" (Google Documents)][3]**

---
####Anforderungen des Host Servers:
- PHP 5.3+
- MySQL 5.5+
- libssh2 (`apt-get install libssh2 libssh2-1 libssh2-1-dev libssh2-php`)
- mind. 250 MB Speicherplatz
- PHP-Memory Limit:  mind. 64 MB. 

---

####Anforderungen des fernsteuerbaren Server:

Getestete Distributionen:
- Ubuntu 12.04 LTS
- Ubuntu 10.04
- Lubuntu 12.04
- Ubuntu Server 12.04

#####erforderliche (zusätzliche) Pakete:
- <code>apache2, apache2-doc, apache2-utils, apache2.2-bin</code>
- <code>mysql-server, mysql-server-5.5 ,mysql-server-core</code>
- <code>lynx, lynx-cur</code>
- <code>openssh, openssh-server</code>
- <code>php5, php5-common, php5-mysql</code>
- <code>proftpd</code>
- <code>zip, unzip, unrar</code>
- <code>apt, bash, hostname</code>

[1]: http://goo.gl/dTrur
[2]: http://46.38.238.216/SAS
[3]: http://goo.gl/8UqKr
[4]: http://goo.gl/OZT5x
[logo2]: http://mangopix.de/local_images/sas-logo2.png

