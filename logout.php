<?php
require_once('functions.php');
require_once('Database.php');
$Database = new Database('localhost', 'root', '', 'Doingsdone');
    check($Database->getLastError());

unset($_SESSION['user']);
header('Location: /');
  die();

