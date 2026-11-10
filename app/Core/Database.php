<?php
// Singleton koneksi PDO (dari Acara 8)
class Database
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $c = require __DIR__ . '/../../config/database.php';
            $dsn = "mysql:host={$c['host']};dbname={$c['dbname']};charset={$c['charset']}";
            self::$instance = new PDO($dsn, $c['username'], $c['password'], [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        }
        return self::$instance;
    }
}
