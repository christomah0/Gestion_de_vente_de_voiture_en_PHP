<?php
class Request
{
    public function getMethod() {
        $method = $_SERVER["REQUEST_METHOD"];
        return $method;
    }

    public function getUrl() {
        $url = $_SERVER["REQUEST_URI"] ?? "/";

        if (str_contains($url, "?")) {
            $param_pos = strpos($url, "?");
            $url = substr($url, 0, $param_pos);
        }

        return $url;
    }
}
