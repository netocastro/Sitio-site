<?php

namespace Source\Controllers\Api;

use Source\Models\DailyFood;
use Source\Models\Food;
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
            "pig_id" => FILTER_SANITIZE_NUMBER_INT,
            "food_id" => FILTER_SANITIZE_NUMBER_INT,
            "amount" => [FILTER_SANITIZE_NUMBER_FLOAT => FILTER_FLAG_ALLOW_FRACTION],
            "date" => FILTER_SANITIZE_STRING
        ]);

        /*$data['amount'] = preg_replace("/[^0-9\.]/", "", $data['amount']);

        echo json_encode(preg_match("/[^0-9]*[.][^0-9]{2,3}/", $data['amount']));*/

      //  echo json_encode(objectToArray((new DailyFood())->find('pig_id = :pi and date = :d',"pi={$data['pig_id']}&d={$data['date']}")->fetch()));

       // return;

        $validateFields = [];

        $user = (isset($_SESSION['userInfo']) ? $_SESSION['userInfo']->id : '');

        if (!(new Pig())->find('user_id = :ui', "ui={$user}")->fetch()) {
            $validateFields['pig_id'] = 'Esse porco não pertence a esse usuário';
        }

        if (!(new Pig())->findById($data['pig_id'])) {
            $validateFields['pig_id'] = 'Esse porco não está cadastrado';
        }

        if (!(new Food())->findById($data['food_id'])) {
            $validateFields['food_id'] = 'Essa ração não está cadastrada';
        }

        if ((new DailyFood())->find('pig_id = :pi and date = :d',"pi={$data['pig_id']}&d={$data['date']}")->fetch()) {
            $validateFields['amount'] = 'Esse Porco ja foi alimentado nessa data';
        }

        if ($validateFields) {
            echo json_encode(['validateFields' => $validateFields]);
            return;
        }

        $daily_food = new DailyFood();
        $daily_food->pig_id = $data['pig_id'];
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
        //echo json_encode($data);
        //exit;
        $daily_food = (new DailyFood())->findById($data['id']);

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
