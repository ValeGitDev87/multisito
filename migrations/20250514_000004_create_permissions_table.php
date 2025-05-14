<?php
// migrations/20250514_000004_create_permissions_table.php

use Core\Migration;

class CreatePermissionsTable extends Migration
{
    public function up(\PDO $db): void
    {
        $db->exec(<<<'SQL'
            CREATE TABLE IF NOT EXISTS permissions (
              id            INT AUTO_INCREMENT PRIMARY KEY,
              user_id       INT            NOT NULL,
              suite_id      INT            NOT NULL,
              function_id   INT            DEFAULT NULL,
              created_at    TIMESTAMP      NULL DEFAULT CURRENT_TIMESTAMP,
              updated_at    TIMESTAMP      NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              FOREIGN KEY (user_id)     REFERENCES users(id)     ON DELETE CASCADE,
              FOREIGN KEY (suite_id)    REFERENCES suites(id)    ON DELETE CASCADE,
              FOREIGN KEY (function_id) REFERENCES functions(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        SQL
        );

        // Indici per velocizzare i join
        $db->exec("CREATE INDEX idx_permissions_user   ON permissions(user_id);");
        $db->exec("CREATE INDEX idx_permissions_suite  ON permissions(suite_id);");
        $db->exec("CREATE INDEX idx_permissions_func   ON permissions(function_id);");
    }

    public function down(\PDO $db): void
    {
        $db->exec("DROP TABLE IF EXISTS permissions;");
    }
}
