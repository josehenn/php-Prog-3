<?php

namespace App\Controllers;

class HomeController extends Controller{

    public function index($request, $response){
        //return $response->write("<h1> Unoesc </h1> <br> Teste aula 3");
        return $this->container->view->render($response, 'index.twig');
    }
}