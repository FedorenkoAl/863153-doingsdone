<?php
require_once('Database.php');
session_start();

/**
*Функция Шаблонизатор
*@param string $name имя файла шаблона
*@param array $data ассоциативный массив с данными для этого шаблона
*
*@return string $result итоговый HTML-код с подставленными данными
*/

function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}


/**
*Функция для проверки  ошибки  выполняемых операций из объекта
*@param string $res вызов метода "getLastError" объекта $Database
*
*@return
*/

function check ($res) {
    if ($res) {
        print($res);
        die();
    }
    return $res;
}
