<?php
namespace app\controllers;

class MainController extends AppController
{
    public function indexAction()
    {
        echo 'Main::index';
    }

    public function testAction()
    {
        echo 'Main::test';
    }
}