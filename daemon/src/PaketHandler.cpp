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
                //Paket behandeln
                break;
            case SMSG_SENT_AUTHRESULT:
                //Paket behandeln
                break;
            default: 
                return SMSG_INVALID_PAKET;
        }
    }
    return _action;
}

char* Out::PreparePaket(int msg) {
    char paket[Out::GetPaketSize(msg)];
    char* pointer;

    if (!msg) 
        paket[0] = CMSG_INVALID_PAKET;

    switch (msg) {
        case CMSG_SEND_CHECKSUM:
            //Paket generieren
            break;
        case CMSG_SEND_AUTHOKAY:
            //Paket generieren
            break;
        default:
            paket[0] = CMSG_INVALID_PAKET;
    }
    pointer = paket;
    return pointer;
}

int Out::GetPaketSize(int msg) {
    switch (msg) {
        case CMSG_SEND_CHECKSUM:
            return 22; // 1-2 = Operation Code 0x0100-0xFF00 | 3 = 0x00; | 5-21 = MD5 Checksum | 22 = 0xFF;
            break;
        case CMSG_SEND_AUTHOKAY:
            return 5;  // 1-2 = Operation Code 0x0100-0xFF00 | 3 = 0x00; | 4 = AuthStatus | 5 = 0xFF;
            break;
        default:
            return CMSG_INVALID_PAKET;
    }
}
