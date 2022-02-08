<?php

require_once __DIR__ . '/setting.php';


$teams = $pdo->query('SELECT `teams`.*, COUNT(`goals`.`gs_id`) AS `rating`
FROM `teams`, `players`, `goals`
WHERE `players`.`ps_team_id` = `teams`.`ts_id`
AND `players`.`ps_id` = `goals`.`gs_player_id`
GROUP BY `teams`.`ts_id`
ORDER BY `rating` DESC')->fetchAll();

require_once __DIR__ . '/head.php';
?>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Рейтинг</th>
        <th>Игроки</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($teams as $team) {
        echo '<tr><td>' . $team['ts_id'] . '</td><td>' . $team['ts_name'] . '</td><td>' . $team['rating'] . '</td><td><a class="orangeButton" href="/players.php?ts_id=' . $team['ts_id'] . '">список</td></tr>';
    }
    ?>
    </tbody>
</table>
<?php
require_once __DIR__ . '/foot.php';
?>