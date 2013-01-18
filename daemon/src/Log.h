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

class sLog {
public:
	void info(char* _msg);
	void error(char* _msg);
	void debug(char* _msg);
	char* createMessage(int color);
private:
	enum ConsoleColors {
		COLOR_WHITE		= 0x00,
		COLOR_BLACK		= 0x01,
		COLOR_RED 		= 0x02,
		COLOR_GREEN 	= 0x04,
		COLOR_YELLOW	= 0x08,
		COLOR_BLUE		= 0x10,
		COLOR_PURPLE	= 0x20,
		COLOR_AWESOME	= 0x40
	};
};
