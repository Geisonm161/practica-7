<?php

declare(strict_types=1);

final class Database
{
    public static function connect(): PDO
    {
        $host = self::environment('DB_HOST');
        $port = self::environment('DB_PORT', '3306');
        $database = self::environment('DB_NAME');
        $user = self::environment('DB_USER');
        $password = self::environment('DB_PASSWORD');

        $dsn = "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4";

        return new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }

    private static function environment(string $name, ?string $default = null): string
    {
        $value = getenv($name);

        if ($value === false || $value === '') {
            if ($default !== null) {
                return $default;
            }

            throw new RuntimeException("Falta la variable de entorno {$name}.");
        }

        return $value;
    }
}
