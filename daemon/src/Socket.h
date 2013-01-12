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

class ServerSocket {
public:
    virtual int GetSocket() { return _socket; }
    virtual int GetSocketsCount() { return _currentCount; }
private:
    unsigned int _currentCount; 
    int _socket;
};

class ClientSocket {
public:
    virtual int GetSocket() { return _socket; }
    virtual unsigned int GetPort() { return _port; }
    void Listen();
    virtual void SetPort(int port) { _port = port; }
private:
    int _port;
    int _socket;
};
