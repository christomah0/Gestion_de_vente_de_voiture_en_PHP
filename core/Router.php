<?php
include_once __DIR__ . "/Request.php";

class Router extends Request
{
    private array $routes;
    private $route_not_found;
    private const METHOD_GET = "GET";
    private const METHOD_POST = "POST";

    public function pageNotFound($callback_func) {
        $this->route_not_found = $callback_func; 
    }

    private function addRoute($method, $url, $handler) {
        $this->routes[$method . $url] = [
            "method" => $method,
            "url" => $url,
            "handler" => $handler
        ];
    }

    public function get($url, $callback_func) {
        $this->addRoute(self::METHOD_GET, $url, $callback_func);
    }

    public function post($url, $callback_func) {
        $this->addRoute(self::METHOD_POST, $url, $callback_func);
    }

    public function run() {
        $req_method = parent::getMethod();
        $req_uri = parent::getUrl();
        $callback_func = null;

        foreach ($this->routes as $route) {
            if ($route["method"] === $req_method && $route["url"] === $req_uri) {
                $callback_func = $route["handler"];
            }
        }
        
        if (!$callback_func) {
            header("HTTP/1.0 404 Not Found");
            $callback_func = $this->route_not_found;
        }

        call_user_func($callback_func);
    }
}
