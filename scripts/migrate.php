<?php
// scripts/migrate.php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../core/Migration.php';

use Core\Config;

// 0) Gestione flag CLI usando getopt
$options    = getopt('', ['rollback', 'fresh']);
$isRollback = array_key_exists('rollback', $options);
$isFresh    = array_key_exists('fresh',    $options);

// 1) Carica configurazione e connessione PDO
$config    = Config::getInstance();
$dbHost    = $config->get('db.host');
$dbName    = $config->get('db.dbname');
$dbUser    = $config->get('db.username');
$dbPass    = $config->get('db.password');
$charsetRaw= $config->get('db.charset') ?: 'utf8mb4';
$dbCharset = explode('_', $charsetRaw)[0];
$dbPort    = $config->get('db.port') ?: null;

$dsnParts = ["host={$dbHost}", "dbname={$dbName}", "charset={$dbCharset}"];
if ($dbPort) {
    $dsnParts[] = "port={$dbPort}";
}
$dsn = 'mysql:' . implode(';', $dsnParts);

try {
    $db = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    echo "Errore di connessione al database: " . $e->getMessage() . PHP_EOL;
    exit(1);
}

// 2) Fresh: droppa tabelle se richiesto
if ($isFresh) {
    echo "Running fresh: dropping all schema..." . PHP_EOL;
    $db->exec("SET FOREIGN_KEY_CHECKS = 0;");
    foreach (['permissions','functions','suites','users','migrations'] as $tbl) {
        $db->exec("DROP TABLE IF EXISTS `{$tbl}`;");
    }
    $db->exec("SET FOREIGN_KEY_CHECKS = 1;");
    echo "Database azzerato.\n";
}

// 3) Rollback: annulla ultimo batch se richiesto
if ($isRollback) {
    echo "Running rollback of last batch..." . PHP_EOL;
    // Assicurati esista la tabella migrations
    $db->exec(<<<'SQL'
CREATE TABLE IF NOT EXISTS migrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    migration VARCHAR(255) NOT NULL,
    batch INT NOT NULL,
    migrated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
SQL
    );
    $lastBatch = (int)$db->query("SELECT MAX(batch) FROM migrations")->fetchColumn();
    if ($lastBatch === 0) {
        echo "Nessun batch da rollbackare." . PHP_EOL;
        exit;
    }
    $stmt = $db->prepare("SELECT migration FROM migrations WHERE batch = ? ORDER BY id DESC");
    $stmt->execute([$lastBatch]);
    $toRollback = $stmt->fetchAll(PDO::FETCH_COLUMN);
    foreach ($toRollback as $name) {
        require __DIR__ . "/../migrations/{$name}.php";
        $segments  = array_filter(explode('_', $name), fn($s)=>!ctype_digit($s));
        $className = str_replace(' ', '', ucwords(implode(' ', $segments)));
        if (!class_exists($className)) {
            echo "Classe non trovata: {$className}\n";
            continue;
        }
        /** @var \Core\Migration $m */
        $m = new $className();
        $m->down($db);
        $db->prepare("DELETE FROM migrations WHERE migration = ?")->execute([$name]);
        echo "Rolled back: {$name}\n";
    }
    echo "Rollback batch {$lastBatch} completato." . PHP_EOL;
    exit;
}

// 4) Crea la tabella migrations se non esiste (necessario dopo fresh)
$db->exec(<<<'SQL'
CREATE TABLE IF NOT EXISTS migrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    migration VARCHAR(255) NOT NULL,
    batch INT NOT NULL,
    migrated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
SQL
);

// 5) Recupera le migrazioni applicate
$applied = $db->query("SELECT migration FROM migrations")->fetchAll(PDO::FETCH_COLUMN);

// 6) Recupera file di migrazione
$files = glob(__DIR__ . '/../migrations/*.php');
sort($files);
if (empty($files)) {
    echo "Nessuna migration trovata in /migrations." . PHP_EOL;
    exit;
}

// 7) Calcola il prossimo batch
$lastBatch = (int)$db->query("SELECT MAX(batch) FROM migrations")->fetchColumn();
$batch = $lastBatch + 1;

// 8) Applica le migrazioni mancanti
foreach ($files as $file) {
    $name = basename($file, '.php');
    if (in_array($name, $applied, true)) {
        continue;
    }
    require $file;
    $segments  = array_filter(explode('_', $name), fn($s)=>!ctype_digit($s));
    $className = str_replace(' ', '', ucwords(implode(' ', $segments)));
    if (!class_exists($className)) {
        echo "Classe migration non trovata: {$className}." . PHP_EOL;
        continue;
    }
    /** @var \Core\Migration $migration */
    $migration = new $className();
    echo "Applying {$name}..." . PHP_EOL;
    $migration->up($db);
    $db->prepare("INSERT INTO migrations (migration, batch) VALUES (?, ?)")
       ->execute([$name, $batch]);
}

echo "Tutte le migrazioni sono state applicate." . PHP_EOL;
