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

echo -e "\nSASDaemon wurde erfolgreich installiert und kann nun mittels service SASDaemon start gestartet werden"

