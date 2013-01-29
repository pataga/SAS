#!/bin/bash
clear

while [ "1" = "1" ]; do
echo "#############################"
echo "#### Server Admin System ####"
echo "##### Daemon Installer ######"
echo "#############################"
echo -e "\n"
echo "Ruby installieren <1>"
echo "Daemon starten <2>"
echo "Neuen SOAP KEY generieren <3>"
echo "Aktuellen SOAP KEY anzeigen <4>"
read -p "Auswahl: " -n1 opt

if [ "$opt" = "1" ]; then
    apt-get install ruby1.9.1-full rubygems -fy
    gem install soap4r --include-dependencies
    clear
    read -p "Pakete installiert. Mit beliebiger Taste zum Hauptmenue..." -n1
    clear
fi 

if [ "$opt" = "2" ]; then
    ./SASDaemon.rb
fi 

if [ "$opt" = "3" ]; then
    clear
    openssl rand -base64 32 > SASDaemon.access
    echo "Der neue SOAP Key lautet: "
    cat SASDaemon.access
    echo -e "\n\n"
    read -p "Mit beliebiger Taste zum Hauptmenue..." -n1
    clear
fi

if [ "$opt" = "4" ]; then
    clear
    echo "Der aktuelle SOAP Key lautet: "
    cat SASDaemon.access
    echo -e "\n\n"
    read -p "Mit beliebiger Taste zum Hauptmenue..." -n1
    clear
fi

done
