<?php
session_start();
include 'db.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $clave = $_POST['clave'];

    $stmt = $conexion->prepare("SELECT pass, rol FROM usuarios WHERE nombre = ?");
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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NavBar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="./login.php">Login</a>
        <a href="./registro.php">Sign In</a>
    </div>
    <form method="post">
        Nombre de usuario: <input type="text" name="nombre_usuario" required><br>
        Contraseña: <input type="password" name="clave" required><br>
        <input type="submit" value="Iniciar sesión">
    </form>
    

</body>
</html>