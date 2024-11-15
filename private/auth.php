<?php
header('Content-Type: application/json');

session_start();

$pdo = require 'db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->login) && isset($data->password)) {
    $login = $data->login;
    $password = $data->password;

    // !! Только для тестирования
    if ($login === 'admin' && $password === 'admin') {
        $_SESSION['login'] = 'admin';
        $_SESSION['role'] = 'admin';
        $_SESSION['name'] = 'Тестовый администратор';
        echo json_encode([
            'success' => true,
            'message' => 'Вход выполнен',
            'role' => 'admin',
        ]);
        exit;
    }
    // !! Только для тестирования

    try {
        $stmt = $pdo->prepare("SELECT name, password, role, access FROM users WHERE login = :login LIMIT 1");
        $stmt->execute(['login' => $login]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (!$user['access']) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Аккаунт заблокирован'
                ]);
                exit;
            }
            if ($password === $user['password']) {
                $_SESSION['login'] = $login;
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name'];
                echo json_encode([
                    'success' => true,
                    'message' => 'Вход выполнен',
                    'role' => $user['role'],
                ]);
                exit;
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Неверный пароль'
                ]);
                exit;
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Пользователь не найден'
            ]);
            exit;
        }
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Ошибка базы данных: ' . $e->getMessage()
        ]);
        exit;
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Не найден логин или пароль'
    ]);
}
