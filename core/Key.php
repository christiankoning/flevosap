<?php

class Key
{
    //generate a key (returns string 8 chars)
    public static function GenKey() {
        //gen random bytes
        $bytes = random_bytes(4);
        //convert the binary bytes to hexidecimal and return these
        return bin2hex($bytes);
    }
}