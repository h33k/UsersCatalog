<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header('Location: /public/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Журнал пользователей</title>
    <link rel="stylesheet" href="/webix/webix.css">
    <link rel="stylesheet" href="/css/styles.css">
    <script src="../webix/webix.js"></script>
</head>
<body>
<div id='layout_div' class="custom_container">
    <div id="container">

    </div>
</div>


</body>

<script src="../js/update_users.js"></script>
</html>