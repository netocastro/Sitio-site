<?php

/**
 * Função que gera uma url absoluta apartir de uma uri
 */

function url($uri = null)
{
    if ($uri) {
        return BASE_PATH . "/{$uri}";
    }
    return BASE_PATH;
}

/**
 * Função de validação de nomes com regex
 */

function validateName($name): bool
{
    if (preg_match('/^[a-zA-Z ]+$/', $name)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Função de validação de dinheiro com regex
 */

function validateMoney($money): bool
{
    if (preg_match('/^[0-9]+\,[0-9]{2}$/', $money)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Função de validação de cpf com regex
 */

function validateCpf($cpf): bool
{
    if (preg_match('/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/', $cpf)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Função de validação de email com regex
 */

function validateEmail($email): bool
{
    if (preg_match('/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/', $email)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Função de validação de telefone (Brasil) com com regex
 */

function validatePhone($phone): bool
{
    if (preg_match('/^\([0-9]{2}\)[0-9]{4}\-[0-9]{4}$/', $phone)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Função de validação de celulares (Brasil) com regex
 */

function validateCellPhone($cellPhone): bool
{
    if (preg_match('/^\([0-9]{2}\)[9][0-9]{4}\-[0-9]{4}$/', $cellPhone)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Transforma objetos do tipo DataLayer em arrays
 */

function objectToArray($object): array
{
    $newArray = [];
    if ($object == null) {
        return (array)$newArray;
    }

    if (is_array($object)) {

        foreach ($object as $item => $value) {
            $newArray[] = (array)$value->data();
        }
        return  (array) $newArray;
    } else {
        $newArray = [];
        $newArray[] = (array)$object->data();
        return (array)$newArray;
    }
}
