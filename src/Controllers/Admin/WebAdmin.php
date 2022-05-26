<?php

namespace Source\Controllers\Admin;

use League\Plates\Engine;
use Source\Models\Breed;
use Source\Models\Food;
use Source\Models\Pig;
use Stonks\Router\Router;

class WebAdmin
{
    private Router $route;
    private Engine $view;

    public function __construct($route)
    {
        $this->view = Engine::create(dirname(__DIR__, 3) . "/theme/admin", "php");
        $this->route = $route;
    }

    public function dashboard()
    {
        echo $this->view->render("dashboard", [
            "title" => "Deashboard",
            "route" => $this->route
        ]);
    }

    public function profile()
    {
        echo $this->view->render("profile", [
            "title" => "Pefil",
            "route" => $this->route
        ]);
    }

    public function pigs()
    {
        $user = (isset($_SESSION['userInfo']) ? $_SESSION['userInfo']->id : '');

        $pigs = (new Pig())->find('user_id = :ui', "ui={$user}")->fetch(true);

        echo $this->view->render("pigs", [
            "title" => "Porcos",
            "route" => $this->route,
            "pigs" => $pigs
        ]);
    }

    public function addPig()
    {
        $user = (isset($_SESSION['userInfo']) ? $_SESSION['userInfo']->id : '');

        $pigs = (new Pig())->find('user_id = :ui', "ui={$user}")->fetch(true);

        $breeds = (new Breed())->find()->fetch(true);

        echo $this->view->render("addPig", [
            "title" => "Adicionar Porco",
            "route" => $this->route,
            "pigs" => $pigs,
            "breeds" => $breeds,
        ]);
    }

    public function foods()
    {   
        $user = (isset($_SESSION['userInfo']) ? $_SESSION['userInfo']->id : '');
        
        $foods = (new Food())->find('user_id = :ui', "ui={$user}")->fetch(true);

        echo $this->view->render("foods", [
            "title" => "Rações",
            "route" => $this->route,
            "foods" => $foods
        ]);
    }

    public function addFood()
    {
        $user = (isset($_SESSION['userInfo']) ? $_SESSION['userInfo']->id : '');

        $foods = (new Food())->find('user_id = :ui', "ui={$user}")->fetch(true);
    
        echo $this->view->render("addFood", [
            "title" => "Alimentação diária",
            
            "route" => $this->route,
            "foods" => $foods
        ]);
    }

    public function dailyFoods()
    {
        $date = date('Y-m-d');
        $user = (isset($_SESSION['userInfo']) ? $_SESSION['userInfo']->id : '');

        $pigs = (new Pig())->find('user_id = :ui', "ui={$user}")->fetch(true);

        $feederPigs = [];

        foreach ($pigs as $pig) {
            if ($pig->dailyFood($date)) {
                $feederPigs[] = $pig;
            }
        }
    
        echo $this->view->render("dailyFood", [
            "title" => "Alimentação diária",
            "route" => $this->route,
            "feederPigs" => $feederPigs,
            "date" => $date
        ]);
    }

    public function addDailyFood()
    {
        $user = (isset($_SESSION['userInfo']) ? $_SESSION['userInfo']->id : '');

        $pigs = (new Pig())->find('user_id = :ui', "ui={$user}")->fetch(true);

        $foods = (new Food())->find('user_id = :ui', "ui={$user}")->fetch(true);

        echo $this->view->render("addDailyFood", [
            "title" => "Adicionar Ração",
            "route" => $this->route,
            "pigs" => $pigs,
            "foods" => $foods,
        ]);
    }
}
