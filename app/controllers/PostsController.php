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
            $uploadedFile = $_FILES['image']['tmp_name'];
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $newFileName = time() . '.' . $ext;
            $dirPath = "images/";
            self::imageCheck($uploadedFile,$dirPath, $newFileName);
        }
        $post = new Post();
        $post->name = $_POST['name'];
        $post->body = $_POST['body'];
        $post->image = $newFileName ?? '';
        $post->save();
        return header("Location: /main/test");
    }

    public function showAction()
    {

    }
}