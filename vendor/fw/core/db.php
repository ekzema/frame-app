<?php
namespace fw\core;

use config\ConnectDb;

class Db
{
    protected $pdo;
    protected static $instance;
    public static $queries = [];

    protected function __construct()
    {
        require ROOT . '/config/config_db.php';
        $db = ConnectDb::dsn(ENV);
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);
    }

    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function execute($sql, $params = [])
    {
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function query($sql, $params = [], $findOne = false)
    {
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($params);
        if ($res !== false) {
            if ($findOne)
                return $stmt->fetch(\PDO::FETCH_OBJ);
            return $stmt->fetchAll(\PDO::FETCH_OBJ);
        }
        return[];
    }
}