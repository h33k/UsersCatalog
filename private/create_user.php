<?php

header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') return;

$pdo = require 'db.php';
require 'validate_user_data.php';

$data = json_decode(file_get_contents("php://input"));


$validation_error = validate_user_data($data);
if ($validation_error) {
    echo json_encode($validation_error);
    exit;
}

$stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE login = :login');
$stmt->execute(['login' => $data->login]);
$user_exists = $stmt->fetchColumn();

if ($user_exists) {
    echo json_encode([
        'success' => false,
        'message' => 'Пользователь с таким логином уже существует.'
    ]);
    exit;
}


$stmt = $pdo->prepare('
    INSERT INTO users (name, login, password, role) 
    VALUES (:name, :login, :password, :role)
');

$result = $stmt->execute([
    'name' => $data->name,
    'login' => $data->login,
    'password' => $data->password,
    'role' => $data->role
]);

if ($result) {
    echo json_encode([
        'success' => true,
        'message' => 'Пользователь успешно создан.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Произошла ошибка при создании пользователя.'
    ]);
}

