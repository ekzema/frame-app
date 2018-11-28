<?php

namespace app\models;
use vendor\core\base\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $props = ['name', 'body', 'image'];
}