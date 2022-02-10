<?php

require_once __DIR__ . '/setting.php';


$matches = $pdo->query('SELECT `matches`.* FROM `matches` ORDER BY `matches`.`mch_id` ASC')->fetchAll();


$teams1 = array_column($matches, 'mch_team1_id');
$teams2 = array_column($matches, 'mch_team2_id');


$teamsIds = array_unique(array_merge($teams1, $teams2));


$teams = $pdo->query('SELECT `teams`.* FROM `teams` WHERE `teams`.`ts_id` IN (' . implode(',', $teamsIds) . ')')->fetchAll();


foreach ($teams as $team) {
    $teamsName[$team['ts_id']] = $team['ts_name'];
}

$goals = $pdo->query('SELECT `goals`.`gs_match_id`, `players`.`ps_team_id` AS gs_team_id, SUM(`goals`.`gs_player_id` = `players`.`ps_id`) AS total
FROM `goals`
JOIN `players` ON `goals`.`gs_player_id` = `players`.`ps_id`
GROUP BY `goals`.`gs_match_id`, `players`.`ps_team_id`')->fetchAll();


foreach ($matches as $id => $match) {
    $matches[$id]['gs_team1'] = $matches[$id]['gs_team2'] = 0;
    foreach ($goals as $key => $goal) {
        if ($match['mch_id'] == $goal['gs_match_id']) {
            if ($match['mch_team1_id'] == $goal['gs_team_id']) {
                $matches[$id]['gs_team1'] = $goal['total'];
            } elseif ($match['mch_team2_id'] == $goal['gs_team_id']) {
                $matches[$id]['gs_team2'] = $goal['total'];
            }
            unset($goals[$key]);
        }
    }
}
require_once __DIR__ . '/head.php';
?>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Команды</th>
        <th>Счет</th>
        <th>Подробнее</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($matches as $match) {
        echo '<tr>';
        echo '<td>' . $match['mch_id'] . '</td>';
        echo '<td>' . $teamsName[$match['mch_team1_id']] . ' - ' . $teamsName[$match['mch_team2_id']] . '</td>';
        echo '<td>' . $match['gs_team1'] . ':' . $match['gs_team2'] . '</td>';
        echo '<td><a href="/match.php?mch_id=' . $match['mch_id'] . '">подробнее</a></td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>
