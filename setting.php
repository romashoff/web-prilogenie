<?php

$dbConfig = [
    'host' => 'localhost',
    'user' => 'root',
   /* 'password' => 'root',*/
    'name' => 'romashoff',
    'charset' => 'utf8',
];

$admin = [
    'login' => 'admin',
    'password' => 'admin',
];

session_start();


$pdo = new PDO('mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['name'] . ';charset=' . $dbConfig['charset'], $dbConfig['user'], $dbConfig['password'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
]);


if (isset($_SESSION['login'], $_SESSION['password']) && $_SESSION['login'] == $admin['login'] && $_SESSION['password'] == $admin['password']) {
    $isLogin = true;
} else {
    $isLogin = false;
}