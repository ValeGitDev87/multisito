<?php
// migrations/20250514_000003_create_functions_table.php

use Core\Migration;

class CreateFunctionsTable extends Migration
{
    public function up(\PDO $db): void
    {
        $db->exec(<<<'SQL'
            CREATE TABLE IF NOT EXISTS functions (
              id          INT AUTO_INCREMENT PRIMARY KEY,
              suite_id    INT            NOT NULL,
              name        VARCHAR(100)   NOT NULL,
              route       VARCHAR(200)   NOT NULL,
              icon        VARCHAR(100)   DEFAULT NULL,
              sort_order  SMALLINT       NOT NULL DEFAULT 0,
              created_at  TIMESTAMP      NULL DEFAULT CURRENT_TIMESTAMP,
              updated_at  TIMESTAMP      NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              FOREIGN KEY (suite_id) REFERENCES suites(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        SQL
        );
    }

    public function down(\PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS functions;");
    }
}
