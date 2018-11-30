<?php
error_reporting(-1);
use vendor\core\Router;
$query = rtrim($_SERVER['QUERY_STRING'], '/');
define('www', __DIR__);
define('CORE', dirname(__DIR__).'/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__).'/app');
define('LAYOUT', 'default');

spl_autoload_register(function($class){
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if(file_exists($file)){
        require $file;
    }
});


Router::add('posts/add', ['controller' => 'Posts', 'action' => 'add']);
Router::add('posts', ['controller' => 'Posts', 'action' => 'index']);
Router::add('post/:id', ['controller' => 'Posts', 'action' => 'show']);
Router::add('', ['controller' => 'Main', 'action' => 'index']);
Router::add('main/test', ['controller' => 'Main', 'action' => 'test']);


//if (Router::matchRoute($query)) {
//    print_r(Router::getRoute());
//} else {
//    echo '404';
//}
Router::dispatch($query);