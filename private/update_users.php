<?php

header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') return;

$pdo = require 'db.php';
require 'validate_user_data.php';

// получение параметров logins и mode из url
$logins = isset($_GET['logins']) ? explode(';', $_GET['logins']) : [];
$mode = $_GET['mode'] ?? null;

if ($mode == 2 && empty($logins)) {
    echo json_encode(['success' => false, 'message' => 'Не указаны логины пользователей.']);
    exit;
}

// если mode равен 2, то меняем значение access для указанных логинов
if ($mode === '2') {
    foreach ($logins as $login) {
        $sql = "UPDATE users SET access = NOT access WHERE login = :login";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['login' => $login]);

        if (!$stmt) {
            echo json_encode([
                'success' => false,
                'message' => "Не удалось обновить доступ для пользователя $login."
            ]);
            exit;
        }
    }

    echo json_encode([
        'success' => true,
        'message' => "Доступ для пользователей успешно обновлен."
    ]);
    exit;
}


$data = json_decode(file_get_contents("php://input"));

if (!is_array($data) || empty($data)) {
    echo json_encode(['success' => false, 'message' => 'Неверный формат данных.']);
    exit;
}

foreach ($data as $user) {
    $validation_error = validate_user_data($user);
    if ($validation_error) {
        echo json_encode($validation_error);
        exit;
    }

    // проверка существования пользователя
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE login = :login');
    $stmt->execute(['login' => $user->login]);
    $user_exists = $stmt->fetchColumn();

    if (!$user_exists) {
        echo json_encode([
            'success' => false,
            'message' => "Пользователь с логином {$user->login} не существует."
        ]);
        exit;
    }

    $stmt = $pdo->prepare('
        UPDATE users 
        SET name = :name, password = :password, role = :role 
        WHERE login = :login
    ');

    $result = $stmt->execute([
        'name' => $user->name,
        'password' => $user->password,
        'role' => $user->role,
        'login' => $user->login
    ]);

    if (!$result) {
        echo json_encode([
            'success' => false,
            'message' => "Не удалось обновить пользователя с логином {$user->login}."
        ]);
        exit;
    }
}

echo json_encode(['success' => true, 'message' => 'Все пользователи успешно обновлены.']);
