<?php

include_once 'uri.php';

$fields = parse_url($uri);


$conn = "mysql:";
$conn .= "host=" . $fields["host"];
$conn .= ";port=" . $fields["port"];;
$conn .= ";dbname=defaultdb";
$conn .= ";sslmode=verify-ca;sslrootcert='C:\wamp64\www\API-PHP-main/ca.pem'";

function conection()
{
    try {
        global $conn, $fields;
        $GLOBALS['PDO'] = new PDO($conn, $fields["user"], $fields["pass"]);
    
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
