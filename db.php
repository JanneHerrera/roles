<?php
$host = 'localhost';
$usuario = 'root';
$clave = '';
$bd = 'control_usuarios';

$conexion = new mysqli($host, $usuario, $clave, $bd);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
