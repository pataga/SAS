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

enum ServerMessages {
    SMSG_INVALID_PAKET              =   0x00,
    SMSG_GIVE_CHECKSUM              =   0x01,
    SMSG_SENT_AUTHRESULT            =   0x02,
    SMSG_SENT_COMMAND				=	0x03,
};
