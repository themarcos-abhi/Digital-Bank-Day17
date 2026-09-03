<?php
function db(): PDO {
    static $pdo = null;
    if ($pdo) return $pdo;
    $cfg = require __DIR__ . '/../config.php';
    if (!is_dir(dirname($cfg['db_path']))) mkdir(dirname($cfg['db_path']), 0775, true);
    $pdo = new PDO('sqlite:' . $cfg['db_path']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->exec('PRAGMA foreign_keys = ON');
    return $pdo;
}
