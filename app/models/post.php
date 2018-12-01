<?php

namespace app\models;
use fw\core\base\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $props = ['name', 'body', 'image'];
}