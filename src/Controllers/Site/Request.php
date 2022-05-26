<?php

namespace Source\Controllers\Site;

use League\Plates\Engine;
use Source\Models\User;
use Stonks\Router\Router;

class Request
{
    public function login($data)
    {
        $findEmptyFields = array_keys($data, '');

        if ($findEmptyFields) {
            echo json_encode(['emptyFields' => $findEmptyFields]);
            return;
        }

        $data = filter_var_array($data, [
            "password" => FILTER_SANITIZE_STRIPPED,
            "email" => FILTER_VALIDATE_EMAIL
        ]);

        $validateFields = [];
        $user = (new User())->find('email = :e', "e={$data['email']}")->fetch();

        if (!$user || !password_verify($data['password'], $user->password)) {
            $validateFields['password'] = 'Informações inválidas';
        }

        if ($validateFields) {
            echo json_encode(['validateFields' => $validateFields]);
            return;
        }
        if ($user) {
            $_SESSION['userInfo'] = $user;
            echo json_encode(['success' => 'success']);
        }
    }
}
