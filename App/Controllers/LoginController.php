<?php

namespace App\Controllers;

use App\Repositories\UserRepository;

class LoginController
{
    public function showLoginForm()
    {
        return require_once __DIR__ . '/../Views/LoginView.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: /');
    }


    public function login()
    {
        $userDB = new UserRepository();
        $user = $userDB->findUser($_POST['user']);


        if (!$user || !password_verify($_POST['password'], $user['password'])) {
            $error = 'Wrong username or password';
            return require_once __DIR__ . '/../Views/LoginView.php';
        }


        $_SESSION['auth_id'] = $user['user'];

        return header('Location: /');

    }

}