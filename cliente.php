<?php

include_once './bd/bd.php';

header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id_cliente'])) {
        $query = "select * from cliente where id_cliente=" . $_GET['id_cliente'];
        $result = metodoGet($query);
        echo json_encode($result->fetch(PDO::FETCH_ASSOC));
    } else {
        $query = "select * from cliente";
        $result = metodoGet($query);
        echo json_encode($result->fetchAll());
    }
}


?>