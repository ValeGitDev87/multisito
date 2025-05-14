<?php
// migrations/20250514_000001_create_users_table.php

use Core\Migration;

class CreateUsersTable extends Migration
{
    public function up(\PDO $db): void
    {
        $db->exec(<<<'SQL'
            CREATE TABLE IF NOT EXISTS users (
              id                  INT AUTO_INCREMENT PRIMARY KEY,
              name                VARCHAR(255) NOT NULL,
              surname             VARCHAR(255) NOT NULL,
              email               VARCHAR(255) NOT NULL UNIQUE,
              password            VARCHAR(255) NOT NULL,
              reset_token         VARCHAR(255) NULL,
              reset_token_expires DATETIME     NULL,
              is_admin            TINYINT(1)   NOT NULL DEFAULT 0,
              created_at          TIMESTAMP    NULL DEFAULT CURRENT_TIMESTAMP,
              updated_at          TIMESTAMP    NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        SQL
        );
    }

    public function down(\PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS users;");
    }
}
