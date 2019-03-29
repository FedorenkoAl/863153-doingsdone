<?php
require_once ('functions.php');
require_once('Database.php');

$Database = new Database('localhost', 'root', '', 'Doingsdone');
    check($Database->getLastError());

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $required = ['email', 'password'];
    $errors = [];
    $error = 'Пожалуйста,исправте ошибки в форме';
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

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'form__input--error';
            $error_email = 'Email должен быт корректным';
            $auth = include_template('auth.php',[
            'title' => 'Дела в порядке',
            'error' =>  $error,
            'errors' => $errors,
            'error_email' => $error_email
            ]);
            print($auth);
            die();
        }
    }

    if (count($errors)) {
        $auth = include_template('auth.php',[
        'title' => 'Дела в порядке',
        'error' =>  $error,
        'errors' => $errors,
        'error_email' => $error_email
        ]);
        print($auth);
        die();
    }

    // $_POST['password'] = htmlspecialchars($_POST['password']);
    $sq_user = "SELECT id, email, password, name FROM user WHERE email IN (?)";
    $Database->executeQuery($sq_user,[$_POST['email']]);
    check($Database->getLastError());
    $pass = $Database->getResultAssocArray();

    if (!$pass['email']) {
        $errors['email'] = 'form__input--error';
        $error_email = 'Неверный email';
        $auth = include_template('auth.php', [
        'title' => 'Дела в порядке',
        'error_email' => $error_email,
        'errors' => $errors,
        'error' =>  $error
        ]);
        print($auth);
        die();
    }

    if (password_verify($_POST['password'], $pass['password'])) {
        $_SESSION['user'] = $pass;
        header('Location: /');

        die();
    }
    else {
        $errors['password'] = 'form__input--error';
        $error_password = 'Неверный пароль';
        $auth = include_template('auth.php', [
        'title' => 'Дела в порядке',
        'error_password' => $error_password,
        'errors' => $errors,
        'error' =>  $error
        ]);
        print($auth);
        die();
    }

}
else {
    $auth = include_template('auth.php',[
    'title' => 'Дела в порядке'
    ]);
}
print($auth);
