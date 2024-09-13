<?php
session_start();
include 'db.php';
include 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $clave = $_POST['clave'];

    $stmt = $conexion->prepare("SELECT clave, rol_id FROM usuarios WHERE nombre_usuario = ?");
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $stmt->bind_result($clave_hash, $rol_id);
    $stmt->fetch();
    $stmt->close();

    if (verificarClave($clave, $clave_hash)) {
        $_SESSION['nombre_usuario'] = $nombre_usuario;
        $_SESSION['rol_id'] = $rol_id;
        echo "Inicio de sesión exitoso.";
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

<form method="post">
    Nombre de usuario: <input type="text" name="nombre_usuario" required><br>
    Contraseña: <input type="password" name="clave" required><br>
    <input type="submit" value="Iniciar sesión">
</form>