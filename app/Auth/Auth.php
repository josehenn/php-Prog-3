<?php

namespace App\Auth;

use App\Models\User;

class Auth
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function user()
    {
        if (isset($_SESSION['user']))
            return User::find($_SESSION['user']);
    }

    public function check()
    {
        return isset($_SESSION['user']);
    }

    public function attempt(string $email, string $password)
    {
        $user = User::where('email', $email)->first();
        $password = User::where('password', $password)->first();

        if (!$user || !$password) {
            $this->container->flash->addMessage('error', 'Suas credenciais parecem está erradas! Por favor, verificar.');
            return false;
        }

        $_SESSION['user'] = $user->id;

        return true;
    }
}
