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
    virtual ServerSocket* GetSocket() { return _socket }
    virtual int GetSocketsCount() { return _currentCount; }
private:
    unsigned int _currentCount; 
    ServerSocket* _socket;
};

class ClientSocket {
public:
    virtual ClientSocket* GetSocket() { return _socket }
    virtual ClientSocket* Listen() { return _socket }
private:
    ServerSocket* _socket;
};
