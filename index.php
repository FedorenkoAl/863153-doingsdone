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

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'Дела в порядке'
]);

print($layout_content);
