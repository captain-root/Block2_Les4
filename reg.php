<?php
require_once 'core/core.php';
$attention = '';
if(!empty($_POST['name'])){
    $name = htmlspecialchars($_POST['name']);
}else{
    $name = 'Неизвестный Енот';
}
if(!empty($_POST['login']) && !empty($_POST['password'])){
    $login = htmlspecialchars($_POST['login']);
    $password = md5($_POST['password']);
    addUser($login, $password, $name);
    redirect('index');
}else{
    $attention = 'Заполните все поля формы';
}
noAdmin();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel=" stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <h2>Регистрация нового пользователя</h2>
    <p><?php echo $attention ?></p>
    <form class="form-reg" action="reg.php" method="post">
        <div>
            <label for="name">Имя: </label>
            <input id="name" type="text" name="name">
        </div>
        <div>
            <label for="login">Логин: </label>
            <input id="login" type="text" name="login">*
        </div>
        <div>
            <label for="password">Пароль: </label>
            <input id="password" type="password" name="password">*
        </div>
        <input type="submit" value="Зарегистрироваться" name="submitReg">
    </form>
    <p>* - Обязательные поля для заполнения</p>
</div>
</body>
</html>