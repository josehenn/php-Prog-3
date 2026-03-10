<?php

namespace App\Controllers;

class HomeController extends Controller {

    public function index($request, $response){
        // controller é responsavel por mostrar a view "orquestra a view"
        return $this->container->view->render($response, 'index.twig');
    }
}