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
    header('HTTP/1.1 200 0K');
    exit();
}

if ($_POST['METHOD'] == 'POST') {
    unset($_POST['METHOD']);
    $id_tipo_documento = $_POST['id_tipo_documento'];
    $numero_documento = $_POST['numero_documento'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo_electronico = $_POST['correo_electronico'];
    $direccion = $_POST['direccion'];

    $query = "insert into cliente(id_tipo_documento, numero_documento, telefono, direccion, correo_electronico, nombre, apellido) values ('$id_tipo_documento', '$numero_documento', '$telefono','$direccion', '$correo_electronico', '$nombre', '$apellido')";
    $queryAutoIncrement = "select MAX(id_cliente) as id_cliente from cliente";
    $result = metodoPost($query, $queryAutoIncrement);
    echo json_encode($result);
    header('HTTP/1.1 200 0K');
    exit();
}

if ($_POST['METHOD'] == 'PUT') {
    unset($_POST['METHOD']);
    $id_cliente = $_GET['id_cliente'];
    $id_tipo_documento = $_POST['id_tipo_documento'];
    $numero_documento = $_POST['numero_documento'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $correo_electronico = $_POST['correo_electronico'];
    $direccion = $_POST['direccion'];
    

    $query = "update cliente set id_tipo_documento='$id_tipo_documento', numero_documento='$numero_documento', nombre='$nombre', apellido='$apellido', telefono='$telefono',correo_electronico='$correo_electronico',direccion='$direccion' where id_cliente='$id_cliente'";
    $result = metodoPut($query);
    echo json_encode($result);
    header('HTTP/1.1 200 0K');
    exit();
}

if ($_POST['METHOD'] == 'DELETE') {
    unset($_POST['METHOD']);
    $id_cliente = $_GET['id_cliente'];
    $query = "delete from cliente where id_cliente='$id_cliente'";
    $result = metodoDelete($query);
    echo json_encode($result);
    header('HTTP/1.1 200 0K');
    exit();
}

?>