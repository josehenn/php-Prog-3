<?php

namespace App\Controllers;

use App\Models\User;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{

    public function login($request, $response)
    {
        if ($request->isGet())
            return $this->container->view->render($response, 'login.twig');

        if (!$this->container->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password'))) {
            return $response->withRedirect($this->container->router->pathFor('auth.login'));
        }

        return $response->withRedirect($this->container->router->pathFor('home'));

    }

    public function register($request, $response)
    {
        if ($request->isGet())
            return $this->container->view->render($response, 'register.twig');

        $validation = $this->container->validator->validate($request, [
            'name' => v::notEmpty()->alpha()->length(10),
            'email' => v::notEmpty()->noWhitespace()->email(),
            'password' => v::notEmpty()->noWhitespace()
        ]);

        if ($validation->failed()) {
            return $response->withRedirect(
                $this->container->router->pathFor('auth.register')
            );
        }

        $horadataatual = new \Datetime();
        $horadataatual->format('d/m/Y H:i:s');

        User::create([
            'name' => $request->getParam('name'),
            'email' => $request->getParam('email'),
            'password' => $request->getParam('password'),
            'confirmation_key' => 'dsadasdas',
            'confirmation_expires' => $horadataatual
        ]);

        $response->withRedirect($this->container->router->pathFor('auth.login'));
    }
}