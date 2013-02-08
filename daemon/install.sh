#!/bin/bash
clear

while [ "1" = "1" ]; do
echo "#############################"
echo "#### Server Admin System ####"
echo "##### Daemon Installer ######"
echo "#############################"
echo -e "\n"
echo "Abhaengigkeiten installieren <1>"
echo "Daemon installieren <2>"
echo "Daemon starten <3>"
echo "Neuen SOAP KEY generieren <4>"
echo "Aktuellen SOAP KEY anzeigen <5>"
read -p "Auswahl: " -n1 opt

if [ "$opt" = "1" ]; then
    apt-get install ruby1.8-full rubygems -fy
    
    clear
    echo "Pakete wurden installiert. Beginne Implementierung der Bibliotheken..."
    sleep 2
    gem install soap4r --include-dependencies
    cd contrib && tar xfv daemon.tar && cd daemon && chmod a+x setup.rb && ./setup.rb 
    clear
    read -p "Pakete installiert. Mit beliebiger Taste zum Hauptmenue..." -n1
    clear
fi 

if [ "$opt" = "2" ]; then
    rm -rf /SASDaemon.tar
    cp SASDaemon.tar / -f
    cd / && tar xfv SASDaemon.tar
    chmod 770 /usr/bin/SASDaemon
    rm -rf /SASDaemon.tar
fi 

if [ "$opt" = "3" ]; then
    ./SASDaemon.rb
fi 

if [ "$opt" = "4" ]; then
    clear
    openssl rand -base64 32 > SASDaemon.access
    echo "Der neue SOAP Key lautet: "
    cat SASDaemon.access
    echo -e "\n\n"
    read -p "Mit beliebiger Taste zum Hauptmenue..." -n1
    clear
fi

if [ "$opt" = "5" ]; then
    clear
    echo "Der aktuelle SOAP Key lautet: "
    cat SASDaemon.access
    echo -e "\n\n"
    read -p "Mit beliebiger Taste zum Hauptmenue..." -n1
    clear
fi

done
