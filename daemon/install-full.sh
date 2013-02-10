#!/bin/bash
out=`whoami`
if [ "$out" != "root" ]; then
    echo "Der Installer muss als Root ausgefuehrt werden!"
    exit
fi
echo "#############################"
echo "#### Server Admin System ####"
echo "##### Daemon Installer ######"
echo "#############################"
echo -e "\n"
read -p "Installation starten mit beliebiger Taste" -n1
echo -e "\n\n"
echo "Installation wurde gestartet. Dies kann einige Zeit in Anspruch nehmen"
rm -rf /usr/bin/SASDaemon
rm -rf /usr/lib/SASDaemon
rm -rf /var/run/SASDaemon
rm -rf /etc/init.d/SASDaemon
rm -rf /etc/SASDaemon/
cd contrib && tar xfv daemon.tar > /dev/null && cd daemon && chmod a+x setup.rb && ./setup.rb > /dev/null
apt-get install ruby1.8-full -fy > /dev/null
apt-get install rubygems -fy > /dev/null
rm -rf /SASDaemon.tar > /dev/null
cp SASDaemon.tar / -f > /dev/null
cd / && tar xfv SASDaemon.tar > /dev/null
chmod 770 /usr/bin/SASDaemon > /dev/null
rm -rf /SASDaemon.tar > /dev/null
chmod a+x /etc/init.d/SASDaemon

read -p "\n\n\nZum Aufrufen des SASDaemon Konfigurationsmanagers die Taste K druecken" -n1 opt
if [ "$opt" = "k" ]; then
    read -p "Wie lautet die Adresse von SAS? " host
    read -p "Welchen Port soll der Daemon verwenden? " port 
    key=`openssl rand -base64 32`
    echo "host=$host" > /etc/SASDaemon/SASd.conf
    echo "port=$port" >> /etc/SASDaemon/SASd.conf
    echo "debug=false" >> /etc/SASDaemon/SASd.conf
    echo "key=$key" >> /etc/SASDaemon/SASd.conf
fi 

echo -e "\nSASDaemon wurde erfolgreich installiert und kann nun mittels 'service SASDaemon start' gestartet werden\n"
