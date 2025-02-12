<?php
namespace Core;

use ORM;

class Database {
    private static $instance = null;

    private function __construct() {
        $config = require __DIR__ . '/../config/config.php';

        ORM::configure([
            'connection_string' => 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'],
            'username' => $config['db']['username'],
            'password' => $config['db']['password'],
            'return_result_sets' => true
        ]);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
