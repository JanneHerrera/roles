<?php
$host = 'localhost';
$usuario = 'root';
$clave = '';
$bd = 'controlusuarios';

$conexion = new mysqli($host, $usuario, $clave, $bd);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
