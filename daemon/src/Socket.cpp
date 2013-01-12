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

#include "Socket.h"

void ClientSocket::Listen() {
     int sockfd, newsockfd, portno;
     char buffer[256];
     struct sockaddr_in serv_addr, cli_addr;
     int n;
     socklen_t clilen;

     if (ClientSocket::GetPort() < 2) {
         printf("Port inkorrekt");
     }

     sockfd = socket(AF_INET, SOCK_STREAM, 0);

     if (sockfd < 0) {
        printf("Socket konnte nicht geoeffnet werden");
     }

     bzero((char *) &serv_addr, sizeof(serv_addr));
     serv_addr.sin_family = AF_INET;
     serv_addr.sin_addr.s_addr = INADDR_ANY;
     serv_addr.sin_port = htons(ClientSocket::GetPort());

     if (bind(sockfd, (struct sockaddr *) &serv_addr, sizeof(serv_addr)) < 0) {
        printf("Fehler bei der Instandhaltung des Sockets");
     }

     listen(sockfd,5);
     clilen = sizeof(cli_addr);
     newsockfd = accept(sockfd, (struct sockaddr *) &cli_addr, &clilen);

     if (newsockfd < 0) {
        printf("Fehler beim Akzeptieren des Sockets");
     }

     bzero(buffer,256);
     n = read(newsockfd,buffer,255);

     if (n < 0) {
        printf("Es wurde NULL gesendet!");
     }

     _socket = newsockfd;
}
