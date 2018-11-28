<?php
define('www', __DIR__);
define('CORE', dirname(__DIR__).'/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__).'/app');
define('LAYOUT', 'default');
$query = rtrim($_SERVER['QUERY_STRING'], '/');
error_reporting(-1);
require '../vendor/core/router.php';
require '../vendor/core/db.php';
require '../vendor/core/base/controller.php';
require '../vendor/core/base/view.php';
require '../vendor/core/base/model.php';
require '../app/controllers/AppController.php';
require '../app/controllers/MainController.php';
require '../app/controllers/PostsController.php';
require '../app/models/post.php';

Router::add('posts/add', ['controller' => 'Posts', 'action' => 'add']);
Router::add('posts', ['controller' => 'Posts', 'action' => 'index']);
Router::add('posts/show', ['controller' => 'Posts', 'action' => 'show']);
Router::add('', ['controller' => 'Main', 'action' => 'index']);
Router::add('main/test', ['controller' => 'Main', 'action' => 'test']);


//if (Router::matchRoute($query)) {
//    print_r(Router::getRoute());
//} else {
//    echo '404';
//}
Router::dispatch($query);