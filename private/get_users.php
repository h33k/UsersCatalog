<?php
header('Content-Type: application/json');
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') return;

$pdo = require 'db.php';

$logins = isset($_GET['logins']) ? explode(';', $_GET['logins']) : [];

if (count($logins) > 0) {
    $placeholders = implode(',', array_fill(0, count($logins), '?'));
    $sql = "SELECT id, name, login, password, role, access FROM users WHERE login IN ($placeholders)";
} else {
    $sql = "SELECT id, name, login, password, role, access FROM users";
}

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($logins);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($users);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
