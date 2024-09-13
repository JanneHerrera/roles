<?php
include 'db.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $clave = $_POST['clave'];
    $rol_id = $_POST['rol_id'];

    $clave_hash = encriptarClave($clave);
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, pass, rol) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $nombre_usuario, $clave_hash, $rol_id);

    if ($stmt->execute()) {
        echo "Usuario registrado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
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
        Rol:
        <select name="rol_id">
            <?php
            $result = $conexion->query("SELECT id, nombre FROM roles");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Registrar">
    </form>


</body>
</html>