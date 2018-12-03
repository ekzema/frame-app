<?php

namespace fw\core\base;
use fw\core\Db;

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

    public function update($id)
    {
        $params = [];
        $val = '';
        foreach ($this->props as $prop) {
            if (! $this->$prop)
                continue;
            $params[":{$prop}"] = $this->$prop;
            $val .= "{$prop}=:{$prop},";
        }
        $val = rtrim($val,',');
        $sql = "UPDATE $this->table SET $val WHERE id=$id";
        return $this->pdo->execute($sql, $params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id=$id";
        return $this->pdo->execute($sql);
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
        return $this->pdo->query($sql, [$id], true);
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