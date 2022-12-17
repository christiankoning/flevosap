<?php

class Request
{
    public static function buildUri($uri) {
        global $prefix;

        if (empty($prefix)) {
            return $uri;
        }
        if (empty($uri)) {
            return $prefix;
        }
        else if (substr($uri, 0, 1) === "/") {
            return "/".$prefix.$uri;
        }
        else {
            return $prefix."/".$uri;
        }
    }

    public static function uri() {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
    }
}
