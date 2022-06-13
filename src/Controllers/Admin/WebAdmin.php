<?php

namespace Source\Controllers\Admin;

use League\Plates\Engine;
use Source\Models\Breed;
use Source\Models\DailyFood;
use Source\Models\FeedPurchasesHistoric;
use Source\Models\Food;
use Source\Models\FoodStock;
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

        $dailyFoods = (new DailyFood())->find('user_id = :uid and date = :d',"uid={$user}&d={$date}")->fetch(true);

        echo $this->view->render("dailyFood", [
            "title" => "Alimentação diária",
            "route" => $this->route,
            "date" => $date,    
            "dailyFoods" => $dailyFoods
        ]);
    }
    public function foodStock()
    {
        $date = date('Y-m-d');
        $user = (isset($_SESSION['userInfo']) ? $_SESSION['userInfo']->id : '');

        $foodStock = (new FoodStock())->find('user_id = :uid',"uid={$user}")->fetch(true);

       // print_r($foodStock);exit;

        echo $this->view->render("foodStock", [
            "title" => "Estoque de ração",
            "route" => $this->route,
            "date" => $date,    
            "foodStock" => $foodStock
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
    
    public function buyFeed()
    {
        $user = (isset($_SESSION['userInfo']) ? $_SESSION['userInfo']->id : '');

        $pigs = (new Pig())->find('user_id = :ui', "ui={$user}")->fetch(true);

        $foods = (new Food())->find('user_id = :ui', "ui={$user}")->fetch(true);

        echo $this->view->render("buyFeed", [
            "title" => "Adicionar Ração",
            "route" => $this->route,
            "pigs" => $pigs,
            "foods" => $foods,
        ]);
    }

    public function myShopping()
    {
        $user = (isset($_SESSION['userInfo']) ? $_SESSION['userInfo']->id : '');
        $date = date('Y-m-d');

        $feedPurchasesHistoric = (new FeedPurchasesHistoric())->find('user_id = :ui and date = :d', "ui={$user}&d={$date}")->fetch(true);

        echo $this->view->render("myShopping", [
            "title" => "Minhas Compras",
            "route" => $this->route,
            "feedPurchasesHistoric" => $feedPurchasesHistoric,
            "date" => $date
        ]);
    }

}
