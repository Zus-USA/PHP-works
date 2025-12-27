<?php

namespace Cymphone\Database;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $basePath = dirname(__DIR__, 3);
            $config = require $basePath . '/config/database.php';
            $dbConfig = $config['connections'][$config['default']];

            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                $dbConfig['host'],
                $dbConfig['port'],
                $dbConfig['database'],
                $dbConfig['charset']
            );

            try {
                self::$connection = new PDO(
                    $dsn,
                    $dbConfig['username'],
                    $dbConfig['password'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    ]
                );
            } catch (PDOException $e) {
                throw new \Exception("Database connection failed: " . $e->getMessage());
            }
        }

        return self::$connection;
    }

    public static function select(string $query, array $params = []): array
    {
        $stmt = self::getConnection()->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function insert(string $query, array $params = []): bool
    {
        $stmt = self::getConnection()->prepare($query);
        return $stmt->execute($params);
    }

    public static function update(string $query, array $params = []): bool
    {
        $stmt = self::getConnection()->prepare($query);
        return $stmt->execute($params);
    }

    public static function delete(string $query, array $params = []): bool
    {
        $stmt = self::getConnection()->prepare($query);
        return $stmt->execute($params);
    }
}

