<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: /public/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ваш профиль</title>
    <link rel="stylesheet" href="/webix/webix.css">
    <link rel="stylesheet" href="/css/styles.css">
    <script src="/webix/webix.js"></script>
</head>
<body>
<script>
    webix.ui({
        view: "window",
        id: "welcomeWindow",
        head: "Добро пожаловать!",
        width: 500,
        height: 200,
        position: "center",
        body: {
            cols: [
                {
                    view: "template",
                    template: "<div>Ваше ФИО: #name#</div><div>Ваш логин: <b>#login#</b></div>",
                    data: {
                        login: "<?php echo htmlspecialchars($_SESSION['login']); ?>",
                        name: "<?php echo htmlspecialchars($_SESSION['name']); ?>",
                    },
                    autoheight: true,
                    css: "centered_text"

                },
                {
                    view: "button",
                    value: "Выйти",
                    width: 100,
                    height: 50,
                    click: function () {
                        window.location.href = '../public/logout.php';
                    }
                }
            ]
        }
    }).show();
</script>
</body>
</html>
