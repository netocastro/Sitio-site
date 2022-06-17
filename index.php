<?php

use Stonks\Router\Router;

require_once "vendor/autoload.php";

$route = new Router(BASE_PATH);

/**
 *  ------ Site -------
 */
$route->namespace('Source\Controllers\Site');
$route->group(null);

/** Paginas */
$route->get("/", "Web:home", "web.home");
$route->get("/login", "Web:login", "web.login");
$route->get("/logout", "Web:logout", "web.logout");
$route->get("/registro", "Web:register", "web.register");
$route->get("/contato", "Web:contact", "web.contact");
$route->get("/sobre", "Web:about", "web.about");
$route->get("/lista-porcos", "Web:pigList", "web.pigList");
$route->get("/error/{error}", "Web:error", "web.error");

/** Requisições */
$route->post("/login", "Request:login", "request.login");

/**
 *  ------ Admin -------
 */
$route->namespace('Source\Controllers\Admin');
$route->group('admin');

/** Paginas */
$route->get("/", "WebAdmin:dashboard", "webAdmin.dashboard");
$route->get("/porcos", "WebAdmin:pigs", "webAdmin.pigs");
$route->get("/adicionar-porco", "WebAdmin:addPig", "webAdmin.addPig");
$route->get("/racoes", "WebAdmin:foods", "webAdmin.foods");
$route->get("/adicionar-racao", "WebAdmin:addFood", "webAdmin.addFood");
$route->get("/alimentacao-diaria", "WebAdmin:dailyFoods", "webAdmin.dailyFoods");
$route->get("/adicionar-alimentacao", "WebAdmin:addDailyFood", "webAdmin.addDailyFood");
$route->get("/estoque-racao", "WebAdmin:foodStock", "webAdmin.foodStock");
$route->get("/comprar-racao", "WebAdmin:buyFeed", "webAdmin.buyFeed");
$route->get("/compras", "WebAdmin:myShopping", "webAdmin.myShopping");
$route->get("/dashboard", "WebAdmin:dashboard", "webAdmin.dashboard");
$route->get("/perfil", "WebAdmin:profile", "webAdmin.profile");

/** Requisições */
$route->post("/dailyFood", "RequestAdmin:dailyFoods", "requestAdmin.dailyFoods");
$route->post("/myShopping", "RequestAdmin:myShopping", "requestAdmin.myShopping");
$route->put("/changeVaccination", "RequestAdmin:changeVaccination", "requestAdmin.changeVaccination");
$route->put("/changeSerratedTeeth", "RequestAdmin:changeSerratedTeeth", "requestAdmin.changeSerratedTeeth");

/** 
 * API
 */
$route->namespace('Source\Controllers\Api');

$route->group('api');

/** Users */
$route->get("/user", "UserController:index", "user.index");
$route->get("/user/{user}", "UserController:show", "user.show");
$route->post("/user", "UserController:store", "user.store");
$route->put("/user/{user}", "UserController:update", "user.update");
$route->delete("/user/{user}", "UserController:delete", "user.delete");

/** Breed */
$route->get("/breed", "BreedController:index", "breed.index");
$route->get("/breed/{breed}", "BreedController:show", "breed.show");
$route->post("/breed", "BreedController:store", "breed.store");
$route->put("/breed/{breed}", "BreedController:update", "breed.update");
$route->delete("/breed/{breed}", "BreedController:delete", "breed.delete");

/** Pig */
$route->get("/pig", "PigController:index", "pig.index");
$route->get("/pig/{pig}", "PigController:show", "pig.show");
$route->post("/pig", "PigController:store", "pig.store");
$route->put("/pig/{pig}", "PigController:update", "pig.update");
$route->delete("/pig/{pig}", "PigController:delete", "pig.delete");

/** Food */
$route->get("/food", "FoodController:index", "food.index");
$route->get("/food/{food}", "FoodController:show", "food.show");
$route->post("/food", "FoodController:store", "food.store");
$route->put("/food/{food}", "FoodController:update", "food.update");
$route->delete("/food/{food}", "FoodController:delete", "food.delete");

/** Daily Food */
$route->get("/daily_food", "DailyFoodController:index", "dailyFood.index");
$route->get("/daily_food/{daily_food}", "DailyFoodController:show", "dailyFood.show");
$route->post("/daily_food", "DailyFoodController:store", "dailyFood.store");
$route->put("/daily_food/{daily_food}", "DailyFoodController:update", "dailyFood.update");
$route->delete("/daily_food/{daily_food}", "DailyFoodController:delete", "dailyFood.delete");

/**Food Stock */
$route->get("/food_stock", "FoodStockController:index", "foodStock.index");
$route->get("/food_stock/{food_stock}", "FoodStockController:show", "foodStock.show");
$route->post("/food_stock", "FoodStockController:store", "foodStock.store");
$route->put("/food_stock/{food_stock}", "FoodStockController:update", "foodStock.update");
$route->delete("/food_stock/{food_stock}", "FoodStockController:delete", "foodStock.delete");

/** Feed Purchases Historic */
$route->get("/feed_purchases_historic", "FeedPurchasesHistoricController:index", "feedPurchasesHistoric.index");
$route->get("/feed_purchases_historic/{feed_purchases_historic}", "FeedPurchasesHistoricController:show", "feedPurchasesHistoric.show");
$route->post("/feed_purchases_historic", "FeedPurchasesHistoricController:store", "FeedPurchasesHistoric.store");
$route->put("/feed_purchases_historic/{feed_purchases_historic}", "FeedPurchasesHistoricController:update", "feedPurchasesHistoric.update");
$route->delete("/feed_purchases_historic/{feed_purchases_historic}", "FeedPurchasesHistoricController:delete", "feedPurchasesHistoric.delete");

$route->dispatch();

if ($route->error()) {
   echo $route->error();
    //$route->redirect('web.error', ["error" => $route->error()]);
}
