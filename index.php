<?php
require_once 'core/core.php';
$errors = [];
if (isPost()) {
    if(login(getParam('login'), md5(getParam('password')))) {
        redirect('list');
    } else {
        $errors[] = 'Неверные логин или пароль';
    }
}
noAdmin();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link rel=" stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <p><a href="reg.php">Регистрация нового пользователя</a></p>
    <h2>Авторизация</h2>
    <form class="login" action="index.php" method="post">
        <div>
            <label for="login">Логин: </label>
            <input id="login" type="text" name="login">
        </div>
        <div>
            <label for="password">Пароль: </label>
            <input id="password" type="password" name="password">
        </div>
        <input type="submit" value="Войти" name="submitLogin">
    </form>
    <p>
        <a href="list.php">Перейти к решению тестов</a>
    </p>
</div>
</body>
</html>