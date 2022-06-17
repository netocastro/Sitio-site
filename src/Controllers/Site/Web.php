<?php

namespace Source\Controllers\Site;

use League\Plates\Engine;
use Stonks\Router\Router;

class Web
{
    private Router $route;
    private Engine $view;

    public function __construct($route)
    {
        $this->view = Engine::create(dirname(__DIR__, 3) . "/theme", "php");
        $this->route = $route;
    }

    public function home()
    {
        echo $this->view->render("home", [
            "title" => "Home",
            "route" => $this->route
        ]);
    }

    public function contact()
    {
        echo $this->view->render("contact", [
            "title" => "Contato",
            "route" => $this->route
        ]);
    }

    public function about()
    {
        echo $this->view->render("about", [
            "title" => "Sobre",
            "route" => $this->route
        ]);
    }

    public function pigList()
    {
        echo $this->view->render("pigList", [
            "title" => "Lista de Porcos",
            "route" => $this->route
        ]);
    }

    public function login()
    {
        echo $this->view->render("login", [
            "title" => "Login",
            "route" => $this->route
        ]);
    }

    public function logout()
    {
        unset($_SESSION['userInfo']);
        $this->route->redirect('web.home');
    }

    public function register()
    {
        echo $this->view->render("register", [
            "title" => "Registro",
            "route" => $this->route
        ]);
    }
    
    public function error($data)
    {
        echo $this->view->render("error", [
            "title" => "Error: " . $data['error'],
            "route" => $this->route,
            "error" => $data['error']
        ]);
    }


}
