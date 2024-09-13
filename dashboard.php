<?php
session_start();
include 'db.php';

if (!isset($_SESSION['nombre_usuario'])) {
    die("No estás autenticado. <a href='login.php'>Inicia sesión</a>");
}

$rol_id = $_SESSION['rol_id'];

$result = $conexion->query("SELECT nombre FROM roles WHERE id = $rol_id");
$rol = $result->fetch_assoc()['nombre'];

echo "Bienvenido, {$_SESSION['nombre_usuario']}!<br>";
echo "Tu rol es: $rol";
?>

<a href="logout.php">Cerrar sesión</a>