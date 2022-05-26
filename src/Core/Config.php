<?php

/*
* Iniciando as seções
*/
session_start();

/*
*Configura o fuso horário padrão utilizado por todas as funções de data e hora em um script
*/
date_default_timezone_set('America/Sao_Paulo');

/*
* Constante dinâmicos do frontend
*/
define("LANGUAGE","pt-br");
define("CHARSET","utf-8");

/*
* variável que verifica se o servidor é http ou https
*/
$s = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === "on") ? 's' : '');

/*
* Complemento da constante BASE_PATH caso o porjeto não esteja na raiz do servidor
*/
$directory = '/development/2022/PHP/app-pai-porcos';

/*
* Constante que define a url absoluta do projeto
*/
define("BASE_PATH", "http{$s}://{$_SERVER['HTTP_HOST']}{$directory}");

/*
* Constante que define as configurações de conexão com banco de dados
*/
define('DATA_LAYER_CONFIG', [
	'driver' => 'mysql',
	'host' => 'localhost',
	'port' => '3306',
	'dbname' => 'app-pigs',
	'username' => 'root',
	'passwd' => '',
	'options' => [
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
		PDO::ATTR_CASE => PDO::CASE_NATURAL,
	],
]);
