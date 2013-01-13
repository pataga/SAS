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

#include "ServerMessages.h"
#include "ClientMessages.h"
#include "PaketHandler.h"

int In::HandleReceivedPaket(char _byte[]) {
    int _action = 0x00;

    if (_byte[0])
        return SMSG_INVALID_PAKET;

    if (_byte[1]) {
        switch (_byte[1]) {
            case SMSG_GIVE_CHECKSUM:
                _action = CMSG_SEND_CHECKSUM;
                break;
            case SMSG_SENT_AUTHRESULT:
                _action = CMSG_SEND_AUTHOKAY;
                break;
            default: 
                return SMSG_INVALID_PAKET;
        }
    }
    return _action;
}

char* Out::PreparePaket(int msg) {
    char paket[Out::GetPaketSize(msg)];
    char* ptr;

    if (!msg) 
        paket[0] = CMSG_INVALID_PAKET;

    switch (msg) {
        case CMSG_SEND_CHECKSUM:
            paket[0] = (char)CMSG_SEND_CHECKSUM;
            paket[1] = 0x00;
            paket[2] = 0xFF;
            paket[3] = Out::GetChecksum()[0];
            paket[4] = Out::GetChecksum()[1];
            paket[5] = Out::GetChecksum()[2];
            paket[6] = Out::GetChecksum()[3];
            paket[7] = Out::GetChecksum()[4];
            paket[8] = Out::GetChecksum()[5];
            paket[9] = Out::GetChecksum()[6];
            paket[10] = Out::GetChecksum()[7];
            paket[11] = Out::GetChecksum()[8];
            paket[12] = Out::GetChecksum()[9];
            paket[13] = Out::GetChecksum()[10];
            paket[14] = Out::GetChecksum()[11];
            paket[15] = Out::GetChecksum()[12];
            paket[16] = Out::GetChecksum()[13];
            paket[17] = Out::GetChecksum()[14];
            paket[18] = Out::GetChecksum()[15];
            paket[19] = 0xFF;
            break;
        case CMSG_SEND_AUTHOKAY:
            paket[0] = (char)CMSG_SEND_AUTHOKAY;
            paket[1] = 0x00;
            paket[2] = 0xFF;
            paket[3] = Out::GetAuthState();
            paket[4] = 0xFF;
            break;
        default:
            paket[0] = CMSG_INVALID_PAKET;
    }
    ptr = paket;
    return ptr;
}

int Out::GetPaketSize(int msg) {
    switch (msg) {
        case CMSG_SEND_CHECKSUM:
            return 22; // 1-2 = Operation Code 0x0100-0xFF00 | 3 = 0xFF; | 4-19 = MD5 Checksum | 20 = 0xFF;
            break;
        case CMSG_SEND_AUTHOKAY:
            return 5;  // 1-2 = Operation Code 0x0100-0xFF00 | 3 = 0xFF; | 4 = AuthStatus | 5 = 0xFF;
            break;
        default:
            return CMSG_INVALID_PAKET;
    }
}
