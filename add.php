<?php
require_once __DIR__ . '/setting.php';

if (!$isLogin) {
    header('Location:/login.php');
    exit;
}

if (isset($_GET['match'])) {

    if (isset($_GET['match'])) {
       
        $formMatch = $pdo->query('SELECT * FROM `matches` WHERE `mch_id` = ' . intval($_GET['match']))->fetch();

        if (empty($formMatch['mch_id'])) {
            $_SESSION['message'] = 'Ошибка: Такого матча не существует';

            header('Location:/add.php');
            exit;
        }

        if (isset($_GET['player'])) {
           
            $formPlayer = $pdo->query('SELECT * FROM `players` WHERE `ps_team_id` IN (' . $formMatch['mch_team1_id'] . ', ' . $formMatch['mch_team2_id'] . ') AND `ps_id` = ' . intval($_GET['player']))->fetch();
            if (empty($formPlayer['ps_id'])) {
                $_SESSION['message'] = 'Ошибка: Такого игрока не существует';

                header('Location:/add.php?match=' . intval($_GET['match']));
                exit;
            }

            if (isset($_GET['time'])) {
              
                if (intval($_GET['time']) <= 0) {
                    $_SESSION['message'] = 'Ошибка: Время не может быть меньше или равно 0';

                    header('Location:/add.php?match=' . intval($_GET['match']) . '&player=' . intval($_GET['player']));
                    exit;
                }

               
                $pdo->query('INSERT INTO `goals`(`gs_match_id`, `gs_player_id`, `gs_time_from_match_start`) VALUES (' . $formMatch['mch_id'] . ',' . $formPlayer['ps_id'] . ',' . intval($_GET['time']) . ')');

                $_SESSION['message'] = 'Гол ' . $pdo->lastInsertId() . ' добавлен';

                header('Location:/add.php');
                exit;
            }
        }
    }
}


$matches = $pdo->query('SELECT `matches`.* FROM `matches` ORDER BY `matches`.`mch_id` ASC')->fetchAll();


$teams1 = array_column($matches, 'mch_team1_id');
$teams2 = array_column($matches, 'mch_team2_id');


$teamsIds = array_unique(array_merge($teams1, $teams2));

$teams = $pdo->query('SELECT `teams`.* FROM `teams` WHERE `teams`.`ts_id` IN (' . implode(',', $teamsIds) . ')')->fetchAll();


foreach ($teams as $team) {
    $teamsName[$team['ts_id']] = $team['ts_name'];
}

if (!empty($formMatch['mch_id'])) {
    $players = $pdo->query('SELECT `players`.`ps_id`, `players`.`ps_full_name` FROM `players` WHERE `ps_team_id` IN (' . $formMatch['mch_team1_id'] . ', ' . $formMatch['mch_team2_id'] . ') ORDER BY `players`.`ps_id` ASC')->fetchAll();
}

require_once __DIR__ . '/head.php';

if ($isLogin) { ?>
    Вы авторизованы как "<?= htmlspecialchars($admin['login']) ?>"
    <form action="/logout.php" method="post">
        <button class="exitButton" name="logout">Выйти</button>
    </form>
    <hr>
<?php } ?>

<form method="get">
    <label>Матч</label><br>
    <select name="match" required>
        <?php
        foreach ($matches as $match) {
            echo '<option value="' . $match['mch_id'] . '" ' . (!empty($formMatch['mch_id']) && $formMatch['mch_id'] == $match['mch_id'] ? 'selected' : null) . '>' . $teamsName[$match['mch_team1_id']] . ' - ' . $teamsName[$match['mch_team2_id']] . '</option>';
        }
        ?>
    </select><br>

    <?php if (!empty($formMatch['mch_id'])) { ?>
        <label>Игрок</label><br>
        <select name="player" required>
            <?php
            foreach ($players as $player) {
                echo '<option value="' . $player['ps_id'] . '" ' . (!empty($formPlayer['ps_id']) && $formPlayer['ps_id'] == $player['ps_id'] ? 'selected' : null) . '>' . $player['ps_full_name'] . '</option>';
            }
            ?>
        </select><br>
        <?php if (!empty($_GET['player'])) { ?>
            <label>Время от начала матча</label><br>
            <input name="time" type="text" required><br>
        <?php } ?>
    <?php } ?>
    <button class="greenButton">Далее</button>
</form>
