<?php
namespace app\controllers;
use app\models\post;
class PostsController extends AppController
{
    public function indexAction()
    {
        $model = new Post();
        $posts = $model->findAll();
        $this->set(['posts' => $posts]);
    }

    public function testAction()
    {
        echo 'Posts::test';
    }

    public function addAction()
    {
        if (! $_POST)
            return header("Location: /");
        $image = $_FILES ? $_FILES['image'] : false;
        if ($image && $image['size'] > 0) {
            $check = getimagesize($image["tmp_name"]);
            if ($check === false) {
                echo 'Image error';exit;
            }
            $temp = explode(".", strtolower($image['name']));
            $imageFormat = strtolower(end($temp));
            $randomName = round(microtime(true)). rand(1000, 9999). '.' . $imageFormat;
            $newFilename = 'images/' . $randomName;
            if (! move_uploaded_file($image["tmp_name"], $newFilename)) {
                echo 'Image was not loaded';exit;
            }
        }
        $post = new Post();
        $post->name = $_POST['name'];
        $post->body = $_POST['body'];
        $post->image = $randomName ?? '';
        $post->save();
        return header("Location: /main/test");
    }

    public function showAction()
    {

    }
}