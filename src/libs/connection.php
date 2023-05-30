<?php
require_once __DIR__ . '/../../config/database.php';

function db(): PDO
{
    static $pdo;
    if (!$pdo) {
        return new PDO(
            sprintf("mysql:host=%s;dbname=%s;charset=UTF8", DB_HOST, DB_NAME),
            DB_USER,
            #DB_PASSWORD via func
            get_config_value_from_env('/../../docker/.env','DB_PASSWORD'),
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
    return $pdo;
}

?>