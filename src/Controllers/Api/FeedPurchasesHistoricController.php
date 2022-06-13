<?php

namespace Source\Controllers\Api;

use Source\Models\FeedPurchasesHistoric;
use Source\Models\FoodStock;

class FeedPurchasesHistoricController
{
    public function index()
    {
        $feedPurchasesHistoric = objectToArray((new FeedPurchasesHistoric())->find()->fetch(true));
        if (!$feedPurchasesHistoric) {
            echo json_encode(['error' => 'nao ha usuarios cadastrados']);
            return;
        }
        echo json_encode($feedPurchasesHistoric);
    }

    public function show($data)
    {
        if (!filter_var($data['feed_purchases_historic'], FILTER_VALIDATE_INT)) {
            echo json_encode(['error' => 'Id precisa ser valor inteiro.']);
            return;
        }

        $id = filter_var($data['feed_purchases_historic'], FILTER_SANITIZE_NUMBER_INT);
        $feed_purchases_historic = (new FeedPurchasesHistoric())->findById($id);

        if (!$feed_purchases_historic) {
            echo json_encode(['error' => 'Registro de compra nao existe']);
            return;
        }
        echo json_encode(objectToArray($feed_purchases_historic));
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
            "date" => FILTER_SANITIZE_STRING,
            "amount" => [
                FILTER_SANITIZE_NUMBER_FLOAT => FILTER_FLAG_ALLOW_FRACTION
            ],
            "price" => [
                FILTER_SANITIZE_NUMBER_FLOAT => FILTER_FLAG_ALLOW_FRACTION
            ]
        ]);

        $validateFields = [];

        if (!is_numeric($data['amount'])) {
            $validateFields['amount'] = 'valor invalido';
        }

        if (!is_numeric($data['price'])) {
            $validateFields['price'] = 'valor invalido';
        }

        if ($validateFields) {
            echo json_encode(['validateFields' => $validateFields]);
            return;
        }

        $feedPurchasesHistoric = new FeedPurchasesHistoric();

        $feedPurchasesHistoric->user_id = $_SESSION['userInfo']->id;
        $feedPurchasesHistoric->food_id = $data['food_id'];
        $feedPurchasesHistoric->date = $data['date'];
        $feedPurchasesHistoric->amount = $data['amount'];
        $feedPurchasesHistoric->price = $data['price'];

        $feedPurchasesHistoric->save();

        if ($feedPurchasesHistoric->fail()) {
            echo json_encode($feedPurchasesHistoric->fail()->getMessage());
            return;
        }

        $foodStock = (new FoodStock())->find('user_id = :uid and food_id = :fid', "uid={$_SESSION['userInfo']->id}&fid={$data['food_id']}")->fetch();

        if ($foodStock) {
            $foodStock->amount += $data['amount'];

            $foodStock->change()->save();

            if ($foodStock->fail()) {
                echo json_encode($foodStock->fail()->getMessage());
                return;
            }
        } else {
            /**
             * Aqui aparece  o problema que eu comentei no curso de nodejs na fan,
             * o controlador esta fazendo2 funcoes, adicionando  um registro
             * FeedPurchasesHistoric e outro FoodStock isso noa pode acontecer.
             */

            $foodStock = new FoodStock();

            $foodStock->user_id =$_SESSION['userInfo']->id;
            $foodStock->food_id = $data['food_id'];
            $foodStock->amount = $data['amount'];

            $foodStock->save();

            if ($foodStock->fail()) {
                echo json_encode($foodStock->fail()->getMessage());
                return;
            }
        }

        echo json_encode(['success' => 'Registrado com sucesso']);
    }

    public function delete($data)
    {
        //echo json_encode(['id' => $data]);
        $feedPurchasesHistoric = (new FeedPurchasesHistoric())->findById($data['id']);

        if ($feedPurchasesHistoric) {
            if ($feedPurchasesHistoric->destroy()) {
                echo json_encode(['deletedFeedPurchasesHistoric' => 'Registro de compra deletado com sucesso']);
                return;
            } else {
                echo json_encode($feedPurchasesHistoric->fail()->getMessage());
                return;
            }
        } else {
            echo json_encode(['feedPurchasesHistoricError' => 'Registro nao cadastrado']);
            return;
        }
    }
}
