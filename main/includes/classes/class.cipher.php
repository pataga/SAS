<?php

class Cipher {

    private function toAscii($key) {
        for ($i = 0; $i < strlen($key); $i++) {
            $temp[$i] = chr((ord($key[$i]) + $i * 3) + (ord($key[$i]) + $i * 5));
        }

        $ascii = implode($temp);
        for ($itr = 0; $itr < 2; $itr++) {
            for ($i = 0; $i < strlen($ascii); $i++) {
                if ($i % 23 == 0) {
                    $temp .= $ascii[$i];
                }
            }
            $ascii = $temp;
        }

        return $ascii;
    }

    private function shapeAsciiBits($key) {
        for ($i = 0; $i < strlen($key); $i++) {
            @$temp[$i] = ord($key[$i]) << 2;
        }
        return @implode($temp);
    }

    private function splitNumber($key) {
        for ($i = strlen($key) - 1, $itr = 0; $i >= 0; $i--) {
            if ($i % 5 == 0 && strlen($key) - 1 != $i) {
                $itr++;
            }
            @$temp[$itr] .= $key[$i];
        }

        return $temp;
    }

    private function toHex($key) {
        for ($i = 0; $i < count($key); $i++) {
            $temp[$i] = strtoupper(dechex($key[$i]));
        }
        return implode($temp);
    }

    private function addUpOcts($key) {
        for ($i = 0, $itr = 0; $i < strlen($key); $i+=3) {
            @$temp[$itr] = $key[$i] . $key[$i + 1];
            $itr++;
        }

        $a = 0;

        foreach ($temp as $val) {
            $a+=hexdec($val);
        }
        return dechex($a);
    }

    public function generateKey() {
        $key =  "LKNSGAONSOHNOUI3498OIEEN908H4FWOIHWR98HWRIH98R" .
                "HWF8AFW8F383AFJ3A8A38A2H8FA38A3F8HA3F8HAG38A38" .
                "AWJFFWAJK7DJU38JF8392JD3J93DJ939D3J93DJ3IA83KF" .
                "LW83873U3AA383C8H8ON3N8F3N83F3M3F9I3IMV3873VN3" .
                "AFW8AGJ8AWG8AWG9OAWG8OAWG8AWGUNAWIAW7AWI7AWFI7" .
                "J7AWF7WAFI7AFWH7AWFI7AWHFI7AWFI7AWFHI7AHWF7IHA" .
                "FFW7IWFAH7GGIEISEG8ESH8SEHI8SEI8HSEI8SEI8HSEI8" .
                "TWJFFWAJK7DJU38JF8392JD3J93DJ939D3J93DJ3IA83KF"
                . $_SERVER['SERVER_ADDR'] . $_SERVER['SERVER_NAME']
                . $_SERVER['REMOTE_ADDR'] . $_SERVER['SCRIPT_NAME'];


        $key = self::toAscii($key);
        $key = self::shapeAsciiBits($key);
        $key = self::splitNumber($key);
        $key = self::toHex($key);
        $key = self::addUpOcts($key);
        return $key;
    }

    public function encrypt($key, $password) {
        for ($i = 0; $i < strlen($password); $i++) {
            $temp[$i] = dechex(ord($password[$i]) * ord($key));
        }
        return implode(":", $temp);
    }

    public function decrypt($key, $passhash) {
        $temp = explode(":", $passhash);
        $password = "";
        foreach ($temp as $val) {
            $password .= chr(hexdec($val) / ord($key));
        }
        return $password;
    }

}

?>
