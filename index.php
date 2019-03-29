<?php
require_once ('functions.php');
require_once('Database.php');

$Database = new Database('localhost', 'root', '', 'Doingsdone');
    check($Database->getLastError());

$Database -> executeQuery('SELECT name FROM project');
    check($Database->getLastError());

$projekt = $Database->getResultAsArray();



$Database -> executeQuery('SELECT data_end,  status, name FROM task');
    check($Database->getLastError());
$task = $Database->getResultAsArray();

$page_content = include_template('index.php', [
     'projekt' => $projekt,
     'task' => $task
]);

$gust = include_template('guest.php', []);

if (isset($_SESSION['user'])) {
    $content = $page_content;
}
else {
    $content = $gust;
}


$layout_content = include_template('layout.php', [
    'content' => $content,

    'title' => 'Дела в порядке'
]);

print($layout_content);
