<?php
include_once './bd/bd.php';

header('Access-Control-Allow-Origin: *');   
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");



if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['numero_documento'])) {
        $query = "select * from cliente where numero_documento=" . $_GET['numero_documento'];
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Read the raw JSON input
    $json_data = file_get_contents('php://input');

    // Decode the JSON data into a PHP array
    $data = json_decode($json_data, true);

    // Check if JSON decoding was successful
    if ($data === null) {
        // JSON decoding failed
        http_response_code(400); // Bad Request
        echo json_encode(array("error" => "Invalid JSON data"));
        exit;
    }

    // Access the individual values
    $id_tipo_documento = $data['id_tipo_documento'];
    $numero_documento = $data['numero_documento'];
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $telefono = $data['telefono'];
    $correo_electronico = $data['correo_electronico'];
    $direccion = $data['direccion'];

    $query = "insert into cliente(id_tipo_documento, numero_documento, telefono, direccion, correo_electronico, nombre, apellido) values ('$id_tipo_documento', '$numero_documento', '$telefono','$direccion', '$correo_electronico', '$nombre', '$apellido')";

    $queryAutoIncrement = "select MAX(id_cliente) as id_cliente from cliente";
    $result = metodoPost($query, $queryAutoIncrement);
    echo json_encode($result);
    header('HTTP/1.1 200 0K');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $json_data = file_get_contents('php://input');

    // Decode the JSON data into a PHP array
    $data = json_decode($json_data, true);

    // Check if JSON decoding was successful
    if ($data === null) {
        // JSON decoding failed
        http_response_code(400); // Bad Request
        echo json_encode(array("error" => "Invalid JSON data"));
        exit;
    }
    $id_cliente = $_GET['id_cliente'];
    $id_tipo_documento = $data['id_tipo_documento'];
    $numero_documento = $data['numero_documento'];
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $telefono = $data['telefono'];
    $correo_electronico = $data['correo_electronico'];
    $direccion = $data['direccion'];


    $query = "update cliente set id_tipo_documento='$id_tipo_documento', numero_documento='$numero_documento', telefono='$telefono', direccion='$direccion', correo_electronico='$correo_electronico', nombre='$nombre', apellido='$apellido' where id_cliente='$id_cliente'";
    $result = metodoPut($query);
    echo json_encode($result);
    header('HTTP/1.1 200 0K');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $id_cliente = $_GET['id_cliente'];
    $query = "delete from cliente where id_cliente='$id_cliente'";
    $result = metodoDelete($query);
    echo json_encode($result);
    header('HTTP/1.1 200 0K');
    exit();
}
