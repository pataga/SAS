/**
* Licensed under The Apache License
*
* @copyright Copyright 2012-2013 Patrick Farnkopf, Tanja Weiser, Gabriel Wanzek (PaTaGa)
* @link https://github.com/pataga/SAS
* @since SAS v1.0.0
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Patrick Farnkopf
*
*/

#include "Log.h"
#include <stdio.h>

void sLog::info(char* msg) {
	printf("%s[INFO] %s\033[0;29m",sLog::createMessage(COLOR_GREEN),msg);
	printf("\033[0;29m \n");
}

void sLog::error(char* msg) {
	printf("%s[ERROR] %s\033[0;29m",sLog::createMessage(COLOR_YELLOW),msg);
	printf("\033[0;29m \n");
}

void sLog::debug(char* msg) {
	printf("%s[DEBUG] %s\033[0;29m",sLog::createMessage(COLOR_RED),msg);
	printf("\033[0;29m \n");
}

char* sLog::createMessage(int color) {
	switch (color) {
		case COLOR_WHITE:
			return "\033[0;29m";
			break;

		case COLOR_BLACK:
			return "\033[0;29m";
			break;

		case COLOR_RED:
			return "\033[0;31m";
			break;

		case COLOR_GREEN:
			return "\033[0;32m";
			break;

		case COLOR_YELLOW:
			return "\033[0;33m";
			break;

		case COLOR_BLUE:
			return "\033[0;34m";
			break;

		case COLOR_PURPLE:
			return "\033[0;35m";
			break;

		case COLOR_AWESOME:
			return "\033[0;29m";
			break;

		default:
			return "\033[0;29m";
	}
}
