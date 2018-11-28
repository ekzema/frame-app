<?php

namespace vendor\core\base;
use \vendor\core\Db;

abstract class Model
{
    protected $pdo;
    protected $table;
    protected  $props = [];
    protected $pk = 'id';

    public function __construct()
    {
        foreach ($this->props as $prop) {
                 $this->$prop = '';
        }
        $this->pdo = Db::instance();
    }

    public function save()
    {
        $params = [];
        foreach ($this->props as $prop) {
            $params[":{$prop}"] = $this->$prop;
        }
        $fields = str_replace(':', '', implode(', ', array_keys($params)));
        $values = implode(', ', array_keys($params));
        $sql = "INSERT INTO $this->table ($fields) VALUES ($values)";
        return $this->pdo->execute($sql, $params);
    }

    public function query($sql)
    {
        return $this->pdo->execute($sql);
    }

    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }

    public function findOne($id, $field = '')
    {
        $field = $field ?: $this->pk;
        $sql = "SELECT * FROM {$this->table} WHERE $field = ? LIMIT 1";
        return $this->pdo->query($sql, [$id]);
    }

    public function findBySql($sql, $params = [])
    {
        return $this->pdo->query($sql, $params);
    }

    public function findLike($str, $field, $table = '')
    {
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM $table WHERE $field LIKE ?";
        return $this->pdo->query($sql, ['%' .$str. '%']);
    }

}