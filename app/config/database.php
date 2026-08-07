<?php

declare(strict_types=1);

final class Database
{
    private static ?PDO $connection = null;

    public static function connect(): PDO
    {
        if (self::$connection instanceof PDO) {
            return self::$connection;
        }

        $host = getenv('DB_HOST') ?: '127.0.0.1';
        $port = getenv('DB_PORT') ?: '3306';
        $database = getenv('DB_NAME') ?: 'dblibreria';
        $username = getenv('DB_USER') ?: 'root';
        $password = getenv('DB_PASSWORD');

        if ($password === false || $password === '') {
            throw new RuntimeException(
                'La variable de entorno DB_PASSWORD no está configurada.'
            );
        }

        $dsn = "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4";

        try {
            self::$connection = new PDO(
                $dsn,
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );

            return self::$connection;
        } catch (PDOException $exception) {
            throw new RuntimeException(
                'No se pudo establecer la conexión con la base de datos.',
                0,
                $exception
            );
        }
    }

    private function __construct()
    {
    }
}
