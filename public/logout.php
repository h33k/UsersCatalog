<?php
session_start();

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    unset($_SESSION['role']);
    unset($_SESSION['name']);
}
header('Location: /public/login.php');