<?php

namespace Source\Controllers\Api;

use Source\Models\DailyFood;
use Source\Models\Food;
use Source\Models\FoodStock;
use Source\Models\Pig;

class DailyFoodController
{
    public function index()
    {
        $daily_food = objectToArray((new DailyFood())->find()->fetch(true));
        if (!$daily_food) {
            echo json_encode(['error' => 'nao ha usuarios cadastrados']);
            return;
        }
        echo json_encode($daily_food);
    }

    public function show($data)
    {
        if (!filter_var($data['daily_food'], FILTER_VALIDATE_INT)) {
            echo json_encode(['error' => 'Id precisa ser valor inteiro.']);
            return;
        }

        $id = filter_var($data['daily_food'], FILTER_SANITIZE_NUMBER_INT);
        $daily_food = (new DailyFood())->findById($id);

        if (!$daily_food) {
            echo json_encode(['error' => 'Raça nao cadastrado.']);
            return;
        }
        echo json_encode(objectToArray($daily_food));
    }

    public function store($data)
    {
        $findEmptyFields = array_keys($data, '');

        if ($findEmptyFields) {
            echo json_encode(['emptyFields' => $findEmptyFields]);
            return;
        }

        $data = filter_var_array($data, [
            "food_id" => FILTER_SANITIZE_NUMBER_INT,
            "amount" => [FILTER_SANITIZE_NUMBER_FLOAT => FILTER_FLAG_ALLOW_FRACTION],
            "date" => FILTER_SANITIZE_STRING
        ]);

        /*$data['amount'] = preg_replace("/[^0-9\.]/", "", $data['amount']);

        echo json_encode(preg_match("/[^0-9]*[.][^0-9]{2,3}/", $data['amount']));*/

        //  echo json_encode(objectToArray((new DailyFood())->find('pig_id = :pi and date = :d',"pi={$data['pig_id']}&d={$data['date']}")->fetch()));

        // return;

        $validateFields = [];

        if (!is_numeric($data['amount'])) {
            $validateFields['amount'] = 'valor invalido';
        }

        $user = (isset($_SESSION['userInfo']) ? $_SESSION['userInfo']->id : '');

        if (!(new Food())->findById($data['food_id'])) {
            $validateFields['food_id'] = 'Essa ração não está cadastrada';
        }

        $foodStock = (new FoodStock())->find('user_id = :uid and food_id = :fid', "uid={$_SESSION['userInfo']->id}&fid={$data['food_id']}")->fetch();

        if (!$foodStock) {
            $validateFields['amount'] = 'Não há ração no estoque';
        }

        if (isset($foodStock) && ($foodStock->amount - $data['amount']) < 0) {
            $validateFields['amount'] = "Estoque insuficiente!  <span class='ms-1'>Estoque = " . $foodStock->amount . " kg</span>";
        }

        if ($validateFields) {
            echo json_encode(['validateFields' => $validateFields]);
            return;
        }

        if ($foodStock) {
            $foodStock->amount -= $data['amount'];

            $foodStock->change()->save();

            if ($foodStock->fail()) {
                echo json_encode($foodStock->fail()->getMessage());
                return;
            }
        }


        $daily_food = new DailyFood();
        $daily_food->user_id = $_SESSION['userInfo']->id;
        $daily_food->food_id = $data['food_id'];
        $daily_food->date = $data['date'];
        $daily_food->amount = $data['amount'];

        $daily_food->save();

        if ($daily_food->fail()) {
            echo json_encode($daily_food->fail()->getMessage());
            return;
        }
        echo json_encode(['success' => 'Registrado com sucesso']);
    }

    public function delete($data)
    {
        $daily_food = (new DailyFood())->find('user_id = :uid and id = :id', "uid={$_SESSION['userInfo']->id}&id={$data['id']}")->fetch();

        if ($daily_food) {
            if ($daily_food->destroy()) {
                echo json_encode(['deletedDailyFood' => 'Alimentação deletado com sucesso']);
            } else {
                echo json_encode($daily_food->fail()->getMessage());
            }
            return;
        } else {
            echo json_encode(['daily_foodError' => 'Alimentação não cadastrado']);
            return;
        }
    }
}
