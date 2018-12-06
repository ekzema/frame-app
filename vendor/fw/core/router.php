<?php
namespace fw\core;

class Router
{
    private static $routes = [];
    private static $route = [];
    private static $param;

    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function getRoute()
    {
        return self::$route;
    }

    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if ($url == $pattern) {
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        $check = explode("/", $url);
        if (is_numeric(end($check))) {
            self::$param = end($check);
            array_pop($check);
            $url =  implode("/", $check).'/:id';
        }
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';
            if (class_exists($controller)) {
                $cObj = new $controller(self::$route);
                $action = self::$route['action'] . 'Action';
                if (method_exists($cObj, $action)) {
                    $cObj->$action(self::$param);
                    $cObj->getView();
                } else {
                    echo "Метод <b>$controller::$action</b> не найден!";
                }
            } else {
                echo '505';
            }
        } else {
            http_response_code(404);
            echo '404.html';
        }
    }

    protected static function removeQueryString($url)
    {
        if ($url) {
            $params = explode('&', $url, 2);
            if (strpos($params[0], '/') || strlen($params[0])) {
                return trim($params[0], '/');
            } else {
                return '';
            }
        }
    }

}
