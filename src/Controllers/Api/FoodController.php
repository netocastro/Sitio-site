<?php

namespace Source\Controllers\Api;

use Source\Models\Food;

class FoodController
{
    public function index()
    {
        $food = objectToArray((new Food())->find()->fetch(true));
        if (!$food) {
            echo json_encode(['error' => 'nao ha usuarios cadastrados']);
            return;
        }
        echo json_encode($food);
    }

    public function show($data)
    {
        if (!filter_var($data['food'], FILTER_VALIDATE_INT)) {
            echo json_encode(['error' => 'Id precisa ser valor inteiro.']);
            return;
        }

        $id = filter_var($data['food'], FILTER_SANITIZE_NUMBER_INT);
        $food = (new Food())->findById($id);

        if (!$food) {
            echo json_encode(['error' => 'Raça nao cadastrado.']);
            return;
        }
        echo json_encode(objectToArray($food));
    }

    public function store($data)
    {
        $findEmptyFields = array_keys($data, '');

        if ($findEmptyFields) {
            echo json_encode(['emptyFields' => $findEmptyFields]);
            return;
        }

        $data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);

        $validateFields = [];

        if ((new Food())->find('name = :n and user_id = :ui', "n={$data['name']}&ui={$_SESSION['userInfo']->id}")->fetch()) {
            $validateFields['name'] = 'Nome já foi cadastrado';
        }

        if (!validateName($data['name'])) {
            $validateFields['name'] = 'Formato do nome inválido';
        }

        if ($validateFields) {
            echo json_encode(['validateFields' => $validateFields]);
            return;
        }

        $food = new Food();
        $food->user_id = $_SESSION['userInfo']->id;
        $food->name = $data['name'];

        $food->save();

        if ($food->fail()) {
            echo json_encode($food->fail()->getMessage());
            return;
        }
        echo json_encode(['success' => 'Registrado com sucesso']);
    }

    public function delete($data)
    {
        /* o $data['id'] foi colocado para suprir as necessidade da propria aplicação
        para uma api separada e externa alterar para $data['food'] */
        $food = (new Food())->findById($data['id']); 

        if ($food) {
            if ($food->destroy()) {
                echo json_encode(['deletedfood' => 'Ração deletado com sucesso']);
                return;
            } else {
                echo json_encode($food->fail()->getMessage());
                return;
            }
        } else {
            echo json_encode(['foodError' => 'Ração nao cadastrado']);
            return;
        }
    }
}
