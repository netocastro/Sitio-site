<?php

namespace Source\Controllers\Api;

use Source\Models\Pig;

class PigController
{
    public function index()
    {
        $pigs = objectToArray((new Pig())->find()->fetch(true));
        if (!$pigs) {
            echo json_encode(['error' => 'Nao ha porcos cadastrados']);
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
        //echo json_encode(['emptyFields' => preg_match("/^([a-zA-Z0-9]+)$/", $data['name'])]);exit;
        $findEmptyFields = array_keys($data, '');

        if ($findEmptyFields) {
            echo json_encode(['emptyFields' => $findEmptyFields]);
            return;
        }

        $data = filter_var_array($data, [
            "breed_id" => FILTER_SANITIZE_NUMBER_INT,
            "birthday" => FILTER_SANITIZE_STRING,
            "name" => FILTER_SANITIZE_STRING,
            "starting_weight" =>[
                FILTER_SANITIZE_NUMBER_FLOAT => FILTER_FLAG_ALLOW_FRACTION 
            ]
        ]);

        $validateFields = [];

        if(!is_numeric($data['starting_weight'])){
            $validateFields['starting_weight'] = 'valor invalido';
        }

        $name = strtoupper($data['name']);

        if((new Pig)->find('name = :name and user_id = :uid',"name={$name}&uid={$_SESSION['userInfo']->id}")->fetch()){
            $validateFields['name'] = 'Nome usado em um porco';
        }

        if(strlen($data['name']) > 2){
            $validateFields['name'] = 'Digitar apenas 2 caracteres';
        }

        if(!preg_match("/^([a-zA-Z0-9]+)$/", $data['name'])){
            $validateFields['name'] = 'sem caracteres especiais';
        }

        if ($validateFields) {
            echo json_encode(['validateFields' => $validateFields]);
            return;
        }

        $pig = new pig();
        $pig->user_id = $_SESSION['userInfo']->id;
        $pig->name = $name;
        $pig->breed_id = $data['breed_id'];
        $pig->birthday = $data['birthday'];
        $pig->slaughter_day = date('Y-m-d', strtotime("+155 days",strtotime($data['birthday'])));
        $pig->starting_weight = $data['starting_weight'];
        $pig->serrated_teeth = false;
        $pig->vaccination = false;

        $pig->save();

        if ($pig->fail()) {
            echo json_encode($pig->fail()->getMessage());
            return;
        }

        echo json_encode(['success' => 'Registrado com sucesso']);
    }

    public function delete($data)
    {
        $pig = (new pig())->find('user_id = :uid and id = :id', "uid={$_SESSION['userInfo']->id}&id={$data['id']}")->fetch();

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
