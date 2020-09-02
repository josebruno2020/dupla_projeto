<?php
require __DIR__.'/environment.php';

$config = array();

if(ENVIRONMENT == 'development') {
    define("BASE_URL", "http://".$_SERVER['SERVER_NAME']."/dupla_projeto/");
    $config['dbname'] = 'dupla_projeto';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = 'root';
} else {
    define("BASE_URL", "https://".$_SERVER['SERVER_NAME']."/");
    $config['dbname'] = 'dupla_projeto';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
}
global $db;
try {

    $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);

}catch(PDOException $e) {
    echo "ERRO: ".$e->getMessage();
    exit;
}

