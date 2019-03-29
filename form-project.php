<?php
require_once ('functions.php');
require_once('Database.php');

 $projekt_content = include_template('form-project.php', [
     'title' => 'Дела в порядке'
 ]);
 print($projekt_content);
