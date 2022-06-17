<?php

namespace Source\Controllers\Api;

use Source\Models\FoodStock;

class FoodStockController
{
    public function index()
    {
        $foodStock = objectToArray((new FoodStock())->find()->fetch(true));
        if (!$foodStock) {
            echo json_encode(['error' => 'nao ha usuarios cadastrados']);
            return;
        }
        echo json_encode($foodStock);
    }

    public function show($data)
    {
        if (!filter_var($data['foodStock'], FILTER_VALIDATE_INT)) {
            echo json_encode(['error' => 'Id precisa ser valor inteiro.']);
            return;
        }

        $id = filter_var($data['foodStock'], FILTER_SANITIZE_NUMBER_INT);
        $foodStock = (new FoodStock())->findById($id);

        if (!$foodStock) {
            echo json_encode(['error' => 'Registro de compra nao existe']);
            return;
        }
        echo json_encode(objectToArray($foodStock));
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
            "amount" => [
                FILTER_SANITIZE_NUMBER_FLOAT => FILTER_FLAG_ALLOW_FRACTION
            ]
        ]);

        $validateFields = [];

        if (!is_numeric($data['amount'])) {
            $validateFields['amount'] = 'valor invalido';
        }

        if ($validateFields) {
            echo json_encode(['validateFields' => $validateFields]);
            return;
        }

        $foodStock = new FoodStock();

        $foodStock->user_id = $_SESSION['userInfo']->id;
        $foodStock->food_id = $data['food_id'];
        $foodStock->amount = $data['amount'];

        $foodStock->save();

        if ($foodStock->fail()) {
            echo json_encode($foodStock->fail()->getMessage());
            return;
        }
        echo json_encode(['success' => 'Registrado com sucesso']);
    }

    public function delete($data)
    {

        /* o $data['id'] foi colocado para suprir as necessidade da propria aplicação
        para uma api separada e externa alterar para $data['feedPurchasesHistoric'] */
        $foodStock = (new FoodStock())->find('user_id = :uid and id = :id', "uid={$_SESSION['userInfo']->id}&id={$data['id']}")->fetch();

        if ($foodStock) {
            if ($foodStock->destroy()) {
                echo json_encode(['deletedFoodStock' => 'Registro de compra deletado com sucesso']);
                return;
            } else {
                echo json_encode($foodStock->fail()->getMessage());
                return;
            }
        } else {
            echo json_encode(['breedError' => 'Registro nao cadastrado']);
            return;
        }
    }
}
