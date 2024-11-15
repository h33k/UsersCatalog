<?php

function load_env($file) {
    if (!file_exists($file)) {
        throw new Exception(".env файл не найден");
    }

    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $env = [];

    foreach ($lines as $line) {
        // разделение строки на ключ и значение
        list($key, $value) = explode('=', $line, 2);
        $env[trim($key)] = trim($value);
    }

    return $env;
}

$env = load_env('../.env');

$dbHost = $env['DB_HOST'] ?? 'localhost';
$dbPort = $env['DB_PORT'] ?? '3306';
$dbName = $env['DB_NAME'] ?? 'users_catalog';
$dbUser = $env['DB_USER'] ?? 'root';
$dbPass = $env['DB_PASS'] ?? '';

try {
    // подключение к базе данных через PDO
    $dsn = "mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8";
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    // настройка обработки ошибок
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}

// возвращаем объект PDO для использования в других файлах
return $pdo;
