<?php
require_once ('functions.php');
require_once('Database.php');

$Database = new Database('localhost', 'root', '', 'Doingsdone');
    check($Database->getLastError());

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $required = ['email', 'password', 'name'];
    $errors = [];
    $error = 'Пожалуйста, исправьте ошибки в форме';
    foreach ($required as $key) {
        if (empty($_POST[$key])) {
            $errors[$key] = 'form__input--error';
        }
    }

    foreach ($_POST as $key => $value) {
        $save = htmlspecialchars($value);
        $_POST[$key] = $save;
}
    if ($_POST['email']) {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
         $errors['email'] = 'form__item--invalid';
         $error_email = 'E-mail введён некорректно';
         $register_content = include_template('register.php', [
        'title' => 'Дела в порядке',
        'errors' => $errors,
          'error' => $error,
        'error_email' => $error_email
        ]);
        print($register_content);
        die();
        }
    }

    if (count($errors)){
         $register_content = include_template('register.php', [
        'title' => 'Дела в порядке',
        'error' => $error,
        'errors' => $errors
        ]);
        print($register_content);
        die();
    }

    $sq = "SELECT id FROM user WHERE email IN (?) LIMIT 1";
    $Database->executeQuery($sq,[$_POST['email']]);
    check($Database->getLastError());

    if ($Database->getResultAsArray()) {
         $error_email = 'Пользователь с этим email уже зарегистрирован';
         $register_content = include_template('register.php', [
        'title' => 'Дела в порядке',
        'error_email' => $error_email,
        'errors' => $errors
        ]);
        print($register_content);
        die();
    }

    $_POST['password'] = htmlspecialchars($_POST['password']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $date_registration = date('Y-m-d H:i:s');

    $sq = "INSERT INTO user (date_registration, email, name, password)
        VALUES (?, ?, ?, ?)";

    $Database->executeInsert($sq,[$date_registration, $_POST['email'], $_POST['name'], $password]);
    check($Database->getLastError());
    header('Location: /');
    die();

}
else {
    $register_content = include_template('register.php', [
    'title' => 'Дела в порядке'
    ]);
}

print($register_content);
