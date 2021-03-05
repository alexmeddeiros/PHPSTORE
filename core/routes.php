<?php

// Coleção de rotas

$routes = [
    'home' => 'main@index',
    'store' => 'main@store'
];

// defina a action
$action = 'home';

//verifica se existe a acao na query string
if (isset($_GET['a'])) {

    //verifica se as action existe nas routes
    if (!key_exists($_GET['a'], $routes)) {
        $action = 'home';
    } else {
        $action = $_GET['a'];
    }
}

//trata as rotas
$partes = explode('@', $routes[$action]);
$controller = 'core\\controller\\' . ucfirst($partes[0]);
$metodo = $partes[1];

$ctr = new $controller();
$ctr->$metodo();
