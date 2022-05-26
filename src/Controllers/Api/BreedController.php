<?php

namespace Source\Controllers\Api;

use Source\Models\Breed;

class BreedController
{
    public function index()
    {   
        $breed = objectToArray((new Breed())->find()->fetch(true));
        if (!$breed) {
            echo json_encode(['error' => 'nao ha usuarios cadastrados']);
            return;
        }
        echo json_encode($breed);
    }

    public function show($data)
    {
        if (!filter_var($data['breed'], FILTER_VALIDATE_INT)) {
            echo json_encode(['error' => 'Id precisa ser valor inteiro.']);
            return;
        }

        $id = filter_var($data['breed'], FILTER_SANITIZE_NUMBER_INT);
        $breed = (new Breed())->findById($id);

        if (!$breed) {
            echo json_encode(['error' => 'Raça nao cadastrado.']);
            return;
        }
        echo json_encode(objectToArray($breed));
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

        if ((new Breed())->find('name = :n', "n={$data['name']}")->fetch()) {
            $validateFields['name'] = 'Nome já foi cadastrado';
        }

        if (!validateName($data['name'])) {
            $validateFields['name'] = 'Formato do nome inválido';
        }

        if ($validateFields) {
            echo json_encode(['validateFields' => $validateFields]);
            return;
        }

        $breed = new Breed();
        $breed->name = $data['name'];

        $breed->save();

        if ($breed->fail()) {
            echo json_encode($breed->fail()->getMessage());
            return;
        }
        echo json_encode(['success' => 'Registrado com sucesso']);
    }

    public function delete($data)
    {
        $breed = (new Breed())->findById($data['breed']);

        if ($breed) {
            if ($breed->destroy()) {
                echo json_encode(['deletedbreed' => 'Cliente deletado com sucesso']);
                return;
            } else {
                echo json_encode($breed->fail()->getMessage());
                return;
            }
        } else {
            echo json_encode(['breedError' => 'Cliente nao cadastrado']);
            return;
        }
    }
}
