<?php

namespace Source\Controllers\Api;

use Source\Models\Pig;

class PigController
{
    public function index()
    {
        $pigs = objectToArray((new Pig())->find()->fetch(true));
        if (!$pigs) {
            echo json_encode(['error' => 'nao ha porcos cadastrados']);
            return;
        }
        echo json_encode($pigs);
    }

    public function show($data)
    {
        if (!filter_var($data['pig'], FILTER_VALIDATE_INT)) {
            echo json_encode(['error' => 'Id precisa ser valor inteiro.']);
            return;
        }

        $id = filter_var($data['pig'], FILTER_SANITIZE_NUMBER_INT);
        $pig = (new Pig())->findById($id);

        if (!$pig) {
            echo json_encode(['error' => 'Porco nao cadastrado.']);
            return;
        }
        echo json_encode(objectToArray($pig));
    }

    public function store($data)
    {
       
        $findEmptyFields = array_keys($data, '');

        if ($findEmptyFields) {
            echo json_encode(['emptyFields' => $findEmptyFields]);
            return;
        }

        $data = filter_var_array($data, [
            "breed_id" => FILTER_SANITIZE_NUMBER_INT,
            "birthday" => FILTER_SANITIZE_STRING,
            "slaughter_day" => FILTER_SANITIZE_STRING,
            "starting_weight" =>[
                FILTER_SANITIZE_NUMBER_FLOAT => FILTER_FLAG_ALLOW_FRACTION 
            ]
        ]);

        $validateFields = [];

        if ($validateFields) {
            echo json_encode(['validateFields' => $validateFields]);
            return;
        }

        $pig = new pig();
        $pig->user_id = $_SESSION['userInfo']->id;
        $pig->breed_id = $data['breed_id'];
        $pig->birthday = $data['birthday'];
        $pig->slaughter_day = $data['slaughter_day'];
        $pig->starting_weight = $data['starting_weight'];

        $pig->save();

        if ($pig->fail()) {
            echo json_encode($pig->fail()->getMessage());
            return;
        }

        echo json_encode(['success' => 'Registrado com sucesso']);
    }

    public function delete($data)
    {
        $pig = (new pig())->findById($data['id']);

        if ($pig) { 
            if ($pig->destroy()) {
                echo json_encode(['deletedpig' => 'Pig deletado com sucesso']);
            } else {
                echo json_encode($pig->fail()->getMessage());  
            }
            return;
        } else {
            echo json_encode(['daily_foodError' => 'Pig nao cadastrado']);
            return;
        }
    }
}
