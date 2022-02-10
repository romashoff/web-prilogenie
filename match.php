<?php


if (empty($_GET['mch_id'])) {
    header('Location:/matches.php');
    exit;
}

require_once __DIR__ . '/setting.php';


$match = $pdo->query('SELECT `matches`.* FROM `matches` WHERE `mch_id` = ' . intval($_GET['mch_id']))->fetch();


if (empty($match['mch_id'])) {
    header('Location:/matches.php');
    exit;
}


$teams = $pdo->query('SELECT `teams`.* FROM `teams` WHERE `teams`.`ts_id` IN (' . $match['mch_team1_id'] . ', ' . $match['mch_team2_id'] . ')')->fetchAll();

foreach ($teams as $team) {
    $teamsName[$team['ts_id']] = $team['ts_name'];
}


$goals = $pdo->query('SELECT * FROM `goals`
JOIN `players` ON `goals`.`gs_player_id` = `players`.`ps_id`
WHERE `goals`.`gs_match_id` = ' . $match['mch_id'] . '
ORDER BY `gs_time_from_match_start` ASC')->fetchAll();


foreach ($goals as $goal) {
    $teamsGoals[$goal['ps_team_id']] = empty($teamsGoals[$goal['ps_team_id']]) ? 1 : $teamsGoals[$goal['ps_team_id']] + 1;
}

require_once __DIR__ . '/head.php';
?>

<table>
    <caption>Описание матча</caption>
    <thead>
    <tr>
        <th>ID</th>
        <th>Команда 1</th>
        <th>Команда 2</th>
        <th>Счет</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?= $match['mch_id'] ?></td>
        <td><?= $teamsName[$match['mch_team1_id']] ?></td>
        <td><?= $teamsName[$match['mch_team2_id']] ?></td>
        <td>
            <?= (empty($teamsGoals[$match['mch_team1_id']]) ? 0 : $teamsGoals[$match['mch_team1_id']]) ?>
            :
            <?= (empty($teamsGoals[$match['mch_team2_id']]) ? 0 : $teamsGoals[$match['mch_team2_id']]) ?>
        </td>
    </tr>
    </tbody>
</table>
<br>
<table>
    <caption>Список голов матча</caption>
    <thead>
    <tr>
        <th>Команда</th>
        <th>Игрок</th>
        <th>Роль игрока</th>
        <th>Время от начала матча</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($goals as $goal) {
        echo '<tr>';
        echo '<td>' . $teamsName[$goal['ps_team_id']] . '</td>';
        echo '<td>' . $goal['ps_full_name'] . '</td>';
        echo '<td>' . $goal['ps_role'] . '</td>';
        echo '<td>' . $goal['gs_time_from_match_start'] . '</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>
