<?php
namespace Core;


abstract class Migration
{
    /** Esegui le modifiche allo schema */
    abstract public function up(\PDO $db): void;

    /** Torna indietro (opzionale) */
    public function down(\PDO $db): void
    {
        // override se vuoi il rollback
    }
}
