<?php
namespace config;
class ConnectDb
{
    public static function dsn($env)
    {
        switch ($env) {
            case 'production':
                return ['dsn' => 'mysql:host=localhost;dbname=fw_prod;charset=utf8',
                    'user' => 'root',
                    'pass' => '',
                ];
                break;
            case 'test':
                return ['dsn' => 'mysql:host=localhost;dbname=fw_test;charset=utf8',
                    'user' => 'root',
                    'pass' => '',
                ];
                break;
            default:
                return false;
        }
    }
}

