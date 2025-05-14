<?php
$servername = 'sql312.infinityfree.com';
$username = 'if0_38975421';
$password = 'ZGkFfZgfLhP';
$dbname = "if0_38975421_gestion_cliente";
// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

?>