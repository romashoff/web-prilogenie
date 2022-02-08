<?php


if (empty($_GET['ts_id'])) {
    header('Location:/teams.php');
    exit;
}

require_once __DIR__ . '/setting.php';
$players = $pdo->query('SELECT `players`.*, COUNT(`goals`.`gs_id`) as total
FROM `players`
LEFT JOIN `goals` ON `players`.`ps_id` = `goals`.`gs_player_id`
WHERE `players`.`ps_team_id` = ' . intval($_GET['ts_id']) . '
GROUP BY `players`.`ps_id`
ORDER BY `total` DESC')->fetchAll();


$matches = $pdo->query('SELECT COUNT(*) FROM `matches` WHERE `matches`.`mch_team1_id` = ' . intval($_GET['ts_id']) . ' OR `matches`.`mch_team2_id` = ' . intval($_GET['ts_id']))->fetchColumn();

require_once __DIR__ . '/head.php';
?>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Среднее кол-во голов</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($players as $player) {
        echo '<tr><td>' . $player['ps_id'] . '</td><td>' . $player['ps_full_name'] . '</td><td>' . (empty($matches) ? 0 : $player['total'] / $matches) . '</td></tr>';
    }
    ?>
    </tbody>
</table>
<?php
require_once __DIR__ . '/foot.php';
?>