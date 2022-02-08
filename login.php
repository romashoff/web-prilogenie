<?php
require_once __DIR__ . '/setting.php';

if ($isLogin) {
    header('Location:/add.php');
    exit;
}

if (isset($_POST['login'], $_POST['password'])) {

    if ($_POST['login'] == $admin['login'] && $_POST['password'] == $admin['password']) {
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['password'] = $_POST['password'];
        header('Location:/add.php');
        exit;
    } else {
        $_SESSION['message'] = 'Ошибка: Неверный логин или пароль';
        header('Location:/add.php');
        exit;
    }
}

require_once __DIR__ . '/head.php';
?>
<form method="post">
    <label>Логин</label><br>
    <input name="login" type="text" required><br>
    <label>Пароль</label><br>
    <input name="password" type="password" required><br>
    <button class="greenButton">Войти</button>
</form>
<?php
require_once __DIR__ . '/foot.php';
?>