<?php
global $routes;
$routes = array();

$routes['/home'] = '/home/index';
$routes['/usuario/editar-senha/{id}'] = '/usuario/editar_senha/:id';
$routes['/usuario/editar/{id}'] = '/usuario/editar/:id';
