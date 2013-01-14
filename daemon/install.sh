#!/bin/bash
clear

while [ "1" = "1" ]; do
echo "#############################"
echo "#### Server Admin System ####"
echo "##### Daemon Installer ######"
echo "#############################"
echo -e "\n"
echo "Compiler installieren <1>"
echo "Daemon installieren <2>"
echo "Daemon starten <3>"
read -p "Auswahl: " -n1 opt

if [ "$opt" = "1" ]; then
    apt-get install gcc g++ build-essentials -fy
    clear
    read -p "Pakete installiert. Mit beliebiger Taste zum Hauptmenue..." -n1
    clear
fi 

if [ "$opt" = "2" ]; then
    g++ -oSASDaemon src/Main.cpp
    cp SASDaemon /usr/bin -fr 
    echo -e "#!/bin/bash\nSASDaemon > /dev/null&" > /etc/init.d/SASDaemon
    chmod 777 /etc/init.d/SASDaemon
    clear
    read -p "SASDaemon wurde installiert. Starten mit service SASDaemon. Mit beliebiger Taste zum Hauptmenue..." -n1
    clear
fi 

if [ "$opt" = "3" ]; then
    service SASDaemon
    clear
    read -p "SASDaemon wurde gstartet. Mit beliebiger Taste zum Hauptmenue..." -n1
    clear
fi 
done
