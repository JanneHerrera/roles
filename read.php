<?php
session_start();
include("db.php");

if ($_SESSION['rol_id'] == 1 || $_SESSION['rol_id'] == 5) {

    echo "<script>
    alert('¿Usted qué hace aquí? No tiene permisos para esto');
    window.location.href = './logout.php';
    </script>";
    exit();
} else {
    $result = $conexion->query("
    SELECT usuarios.nombre AS usuario_nombre, roles.nombre AS rol_nombre
    FROM usuarios
    INNER JOIN roles ON usuarios.rol = roles.id");

    while ($row = $result->fetch_assoc()) {
        echo "<h4>Usuario: {$row['usuario_nombre']} - Rol: {$row['rol_nombre']}</h4>";
    }
}
