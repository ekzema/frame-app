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

    public function newAction()
    {
    }

    public function showAction($id)
    {
        $post = self::findPost($id);
        $this->set(['post' => $post]);
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

    public function editAction($id)
    {
        $post = self::findPost($id);
        $this->set(['post' => $post]);
    }

    public function updateAction($id)
    {
        if (! $_POST)
            return header("Location: /");
        $post = new Post();
        $image = $_FILES ? $_FILES['image'] : false;
        if ($image && $image['size'] > 0) {
            $uploadedFile = $_FILES['image']['tmp_name'];
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $newFileName = time() . '.' . $ext;
            $dirPath = "images/";
            self::imageCheck($uploadedFile,$dirPath, $newFileName);
            $obj = self::findPost($id);
            if (file_exists("{$dirPath}{$obj->image}"))
                unlink("{$dirPath}{$obj->image}");
            $post->image = $newFileName;
        }
        $post->name = $_POST['name'];
        $post->body = $_POST['body'];
        $post->update($id);
        return header("Location: /post/edit/{$id}");
    }

    public function deleteAction()
    {
        if (! $_POST)
            return header("Location: /");
        $id = $_POST['id'];
        $dirPath = 'images/';
        $obj = self::findPost($id);
        if ($obj->image && file_exists("{$dirPath}{$obj->image}"))
            unlink("{$dirPath}{$obj->image}");
        $post = new Post();
        $post->delete($id);
        return header("Location: /posts");
    }

    private static function findPost($id)
    {
        $model = new Post();
        $post = $model->findOne($id, 'id');
        if (! $post) {
            http_response_code(404);
            echo "<h1 align='center'>(404) Post not found</h1>";exit;
        }
        return $post;
    }
}