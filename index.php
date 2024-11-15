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
    <script src="webix/webix.js"></script>
</head>
<body>
<div id='layout_div' class="custom_container" data-admin-name="<?php echo $_SESSION['name']; ?>">
    <div id="container">

    </div>
</div>
<div class="custom_container pager_box">
    <div id="pager"></div>
</div>


</body>

<script src="js/core.js"></script>
</html>