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

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <sys/types.h> 
#include <sys/socket.h>
#include <netinet/in.h>
#include "PaketHandler.cpp"
#include "Socket.cpp"

int main() {
    In* in = new In();
    Out* out = new Out();
    ClientSocket* socket = new ClientSocket();

    out->SetChecksum("476a5533998c2b31c81c2d56a25b83a7");
    out->SetAuthState(1);

    socket->SetPort(8000);
    socket->Listen();
    char* paket = socket->ReadPaket();
    int answer = in->HandleReceivedPaket(paket);
    char* outPaket = out->PreparePaket(answer);
    return 0;
}
