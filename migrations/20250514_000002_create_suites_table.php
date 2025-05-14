<?php
// migrations/20250514_000002_create_suites_table.php

use Core\Migration;

class CreateSuitesTable extends Migration
{
    public function up(\PDO $db): void
    {
        $db->exec(<<<'SQL'
            CREATE TABLE IF NOT EXISTS suites (
              id          INT AUTO_INCREMENT PRIMARY KEY,
              name        VARCHAR(100) NOT NULL,
              slug        VARCHAR(100) NOT NULL UNIQUE,
              sort_order  SMALLINT      NOT NULL DEFAULT 0,
              created_at  TIMESTAMP     NULL DEFAULT CURRENT_TIMESTAMP,
              updated_at  TIMESTAMP     NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        SQL
        );
    }

    public function down(\PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS suites;");
    }
}
