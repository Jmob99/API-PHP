<?php

$host = "localhost";
$user = "root";
$password = "";
$bd = "hotel";
$pdo = null;

function conection()
{
    try {
        $GLOBALS['PDO'] = new PDO("mysql:host=" . $GLOBALS['host'] . ";dbname=" . $GLOBALS['bd'] . "", $GLOBALS['user'], $GLOBALS['password']);
        $GLOBALS['PDO']->setAttribute(PDO::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        echo 'Error de la conexion';
        echo "ERROR: " . $e->getMessage();
    }
}

?>