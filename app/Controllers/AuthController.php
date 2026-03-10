<?php

namespace App\Controllers;

class AuthController extends Controller {

    public function login($request, $response)
    {
        return $this->container->view->render($response, 'login.twig');
    }

    public function register($request, $response)
    {
        if ($request->isGet())
            return $this->container->view->render($response, 'register.twig');

        $horadataatual = new \DateTime(date('d/m/y H:i'));

        User::create([
            'name' => $request->getParam('name'),
            'email' => $request->getParam('email'),
            'password' => $request->getParam('password'),
            'confirmation_key' => str_random(40),
            'confirmation_expires' => $horadataatual

        ]);

        $response->withRedirect($this->container->router->pathFor('auth.login'));
    }

}