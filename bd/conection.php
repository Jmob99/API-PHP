<?php

$uri = $_ENV['DATABASE_URL'];

$fields = parse_url($uri);


$conn = "mysql:";
$conn .= "host=" . $fields["host"];
$conn .= ";port=" . $fields["port"];;
$conn .= ";dbname=defaultdb";
$conn .= ";sslrootcert=" . $_ENV["DB_CA_CERT_URL"];

function conection()
{
    try {
        global $conn, $fields;
        $GLOBALS['PDO'] = new PDO($conn, $fields["user"], $fields["pass"]);
    
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
