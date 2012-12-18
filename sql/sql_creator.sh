#!/bin/bash
while [ "1" = "1" ]; do
	head="\n
		####################### \n
		# SQL CREATOR FOR SAS # \n
		####################### \n\n"

	echo -e $head

	echo "Hauptmenue Eintrag erstellen <1>"
	echo -e "Side Navi Eintrag erstellen <2>\n"

	read -p "" -n1 opt

	clear

	if [ "$opt" = "1" ]; then
		while [ "1" = "1" ]
		do 
			read -p "Bitte Get Variable eingeben: " get
			read -p "Bitte Name eingeben: " name
			read -p "Bitte INC Pfad angeben: " path

			echo "INSERT INTO sas_menu_main (name, page) VALUES ('$name', '$get');" >> sas_menu_main.sql 
			echo "INSERT INTO sas_content (page, inc_path) VALUES ('$get', '$path');" >> sas_content.sql
			read -p "Druecke Y um zum Hauptmenue zu kommen oder ENTER zum weitermachen" -n1 cancel

			if [ "$cancel" = "Y" ]; then 
				break; 
			fi
		done
	fi

	if [ "$opt" = "2" ]; then
	    while [ "1" = "1" ]
		do 
			read -p "Bitte Page eingeben (?p=): " page
			read -p "Bitte SubPage eingeben (?s=): " spage
			read -p "Bitte Name eingeben: " name
			read -p "Bitte INC Pfad angeben: " path

			echo "INSERT INTO sas_menu_side (name, page, spage) VALUES ('$name', '$page', '$spage');" >> sas_menu_side.sql 
			echo "INSERT INTO sas_content (page, spage, inc_path) VALUES ('$page', '$spage', '$path');" >> sas_content.sql
			read -p "Druecke Y um zum Hauptmenue zu kommen oder ENTER zum weitermachen" -n1 cancel

			if [ "$cancel" = "Y" ]; then 
				break; 
			fi
		done
	fi
done
