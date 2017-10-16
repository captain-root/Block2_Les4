<?php
const  DATABASE_USERS = 'data/users.json';
function login($login, $password)
{
    $user = getUser($login);
    if (!$user || $user['password'] != $password) {
        return false;
    } else {
        unset($user['password']);
        $_SESSION['user'] = $user;
        return true;
    }
}
function isPost()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}
function getUsers(){
    if(!file_exists(DATABASE_USERS)){
        return [];
    }else{
        $fileData = file_get_contents(DATABASE_USERS);
        $users = json_decode($fileData, true);
    }
    if(!$users){
        return [];
    }else{
        return $users;
    }
}
function getUser($login)
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['login'] == $login) {
            return $user;
        }
    }
    return null;
}
function getParam($name)
{
    return isset($_REQUEST[$name]) ? $_REQUEST[$name] : null;
}
function addUser($login, $password, $username)
{
    $users = getUsers();
    $users[] = [
        'id' => getMaxUserId() + 1,
        'login' => $login,
        'password' => $password,
        'name' => $username,
    ];
    $json = json_encode($users, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    return file_put_contents(DATABASE_USERS, $json);
}
function getMaxUserId()
{
    $users = getUsers();
    $ids = array_column($users, 'id');
    return max($ids);
}
function isAuthorized()
{
    return !empty($_SESSION['user']);
}
function getAuthorizedUser() {
    return isset($_SESSION['user']) ? $_SESSION['user'] : null;
}
function redirect($page) {
    header("Location: $page.php");
    die;
}
function logout() {
    if (isAuthorized()) {
        session_destroy();
    }
    redirect('login');
}
function noAdmin(){
    if(!isAuthorized() && stristr($_SERVER['SCRIPT_FILENAME'], 'admin.php')){
        header('HTTP/1.1 403 Forbidden');
    }
}