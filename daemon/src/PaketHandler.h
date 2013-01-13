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

class In {
public:
    int HandleReceivedPaket(char _byte[]);
};

class Out {
public:
    char* PreparePaket(int msg);
    int GetPaketSize(int msg);
    virtual char* GetChecksum() { return _checksum; }
    virtual void SetChecksum(char checksum[]) { _checksum = checksum; }
    virtual int GetAuthState() { return _authstate; }
    virtual void SetAuthState(int authstate) { _authstate = authstate; } 
private:
    char* _checksum;
    int _authstate;
};
