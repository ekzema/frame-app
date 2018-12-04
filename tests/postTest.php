<?php
//vendor\bin\phpunit --bootstrap vendor\autoload.php tests\postTest
//vendor\bin\phpunit --verbose tests
declare(strict_types=1);
define('www', __DIR__);
define('CORE', dirname(__DIR__).'/vendor/fw/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__).'/app');
define('LAYOUT', 'default');
define('ENV', 'test');
use PHPUnit\Framework\TestCase;
use \app\models\Post;

class PostTest extends TestCase
{
    protected static $model;

    function setUp()
    {
        self::$model = new Post();
    }
    static function findAction($route = [])
    {
        self::assertSame(2, count($route));
        self::assertSame(true, class_exists('app\controllers\\'.$route['controller'].'Controller'), 'Controller not found');
        $cObj = new \app\controllers\PostsController(['action' => $route['action']]);
        $action = $route['action'] . 'Action';
        self::assertSame(true, method_exists($cObj, $action), $action . 'not found');
        return $cObj;
    }

    public function testIndexAction()
    {
        $TestClass = self::findAction(['controller' => 'Posts', 'action' => 'index']);
        $TestClass->indexAction();
        $this->assertTrue(isset($TestClass->vars['posts']));
    }

    public function testAddction()
    {
        self::$model->name = 'test2 name';
        self::$model->body = 'test3 body';
        $this->assertTrue(self::$model->save());
    }

    public function testShowAction()
    {
        $model = new Post();
        $posts = $model->findAll();
        $this->assertTrue(count($posts) > 0, 'Posts is empty');
        $TestClass = self::findAction(['controller' => 'Posts', 'action' => 'show']);
        $TestClass->showAction($posts[0]->id);
        $this->assertTrue(isset($TestClass->vars['post']));
    }

    public function testDeleteAction()
    {
        $posts = self::$model->findAll();
        $this->assertTrue(count($posts) > 0, 'Posts is empty');
        self::$model->delete($posts[0]->id);
        $this->assertTrue(self::$model->delete($posts[0]->id));
    }

    function tearDown() {
        self::$model = NULL;
    }
}