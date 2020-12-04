<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\DefaultService;

class CheckIfLogged
{
    public static function execute()
    {
        if ($_SESSION['auth_id'] == null) {
            return header('Location: /login');
        }
    }
}