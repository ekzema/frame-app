<?php
//vendor\bin\phpunit --bootstrap vendor\autoload.php tests\postTest
//vendor\bin\phpunit --verbose tests
require __DIR__ . '/../vendor/autoload.php';
define('www', __DIR__);
define('CORE', dirname(__DIR__).'/vendor/fw/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__).'/app');
define('LAYOUT', 'default');
use PHPUnit\Framework\TestCase;
class PostTest extends TestCase
{
    protected static $TestClass;
    protected $CI;

//    public function setUp()
//    {
//        self::$TestClass = new \app\controllers\PostsController(['action' => 'index']);
//    }

    static function testFindAction($route = ['controller' => 'Posts', 'action' => 'index'])
    {
        self::assertSame(2, count($route));
        self::assertSame(true, class_exists('app\controllers\\'.$route['controller'].'Controller'), 'Controller not found');
        $cObj = self::$TestClass = new \app\controllers\PostsController(['action' => $route['action']]);
        $action = $route['action'] . 'Action';
        self::assertSame(true, method_exists($cObj, $action), $action . 'not found');
        return self::$TestClass = new \app\controllers\PostsController(['action' => 'index']);
    }


    /**
     * @depends testFindAction
     */
    public function testPushAndPop($TestClass)
    {
        $TestClass->indexAction();
        print_r($TestClass);exit;
        $stack = [];
        $this->assertSame(0, count($stack));

        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack)-1]);
        $this->assertSame(1, count($stack));

        $this->assertSame('foo', array_pop($stack));
        $this->assertSame(0, count($stack));
    }

}