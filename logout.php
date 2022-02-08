<?php
require_once __DIR__ . '/setting.php';

if (isset($_POST['logout'])) {
    unset($_SESSION['login'], $_SESSION['password']);
}

header('Location:/');
exit;