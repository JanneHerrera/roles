<?php
session_start();
include 'db.php';
include 'functions.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['nombre_usuario']) || !isset($_SESSION['rol_id'])) {
    die("No estás autenticado. <a href='login.php'>Inicia sesión</a><br>");
}

// Si el usuario está autenticado, proceder a obtener su rol
$rol_id = $_SESSION['rol_id'];

// Consulta para obtener el nombre del rol
$result = $conexion->prepare("SELECT nombre FROM roles WHERE id = ?");
$result->bind_param("i", $rol_id);
$result->execute();
$result->bind_result($rol);
$result->fetch();
$result->close();

echo "Bienvenido, {$_SESSION['nombre_usuario']}!<br>";
echo "Tu rol es: $rol<br>";


switch ($rol) {
    case 'admin':
        echo "<a href='write.php'>Editar otros usuarios</a><br>";
        echo "<a href='read.php'>Leer información</a><br>";
        break;
    case 'escritura':
        echo "<a href='write.php'>Editar información</a><br>";
        break;
    case 'lectura':
        echo "<a href='read.php'>Leer información</a><br>";
        break;
    default:
        echo "<p>Error en el rol no identificado, se obtuvo la variable: $rol</p><br>";
        break;
}
?>

<a href="logout.php">Cerrar sesión</a>