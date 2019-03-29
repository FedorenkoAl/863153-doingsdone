<?php
require_once ('functions.php');
require_once('Database.php');

$Database = new Database('localhost', 'root', '', 'Doingsdone');
    check($Database->getLastError());
$Database -> executeQuery('SELECT name FROM project');
        check($Database->getLastError());

    $projekt = $Database->getResultAsArray();
    $add = include_template('form-task.php', [
     'title' => 'Дела в порядке',
     'projekt' => $projekt,
     'option' => 'Выберите категорию'
 ]);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $required = ['name', 'project', 'date'];
      $errors = [];
      foreach ($required as $key) {
        if (empty($_POST[$key])) {
            $errors[$key] = 'form__input--error';
        }
    }

    if ($_POST['project'] == 'Выберите категорию') {
        $errors['project'] = 'form__input--error';
        $option = 'Выберите категорию';
    }
    else {
        $option = $_POST['project'];
    }

     foreach ($_POST as $key => $value) {
        $save = htmlspecialchars($value);
        $_POST[$key] = $save;
    }

     $filename = $_FILES['preview']['name'];

    if (!$filename) {
        $errors['preview'] = 'form__input--error';
         $add = include_template('form-task.php', [

        'title' => 'Дела в порядке',
        'projekt' => $projekt,
         'option' => $option ,
         'errors' => $errors,
          'file' => 'файл не выбран'
         ]);
        print($add);
        die();
    }
    // else {
    //     'file' = 'Выбери файл';
    // }
var_dump($_FILES);

    if (count($errors)){
        $add = include_template('form-task.php', [
        'title' => 'Дела в порядке',
        'projekt' => $projekt,
         'option' => $option ,
         'errors' => $errors
         ]);
        print($add);
        die();
    }



}
else {
 // $add = include_template('form-task.php', [
 //     'title' => 'Дела в порядке',
 //     'option' => 'Выберите категорию'
 // ]);
}
 print($add);
