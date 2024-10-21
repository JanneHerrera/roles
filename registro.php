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
require_once 'navBar.php';
?>

<body>

    <div class="navbar">
        <a href="./login.php">Login</a>
        <a href="./registro.php">Sign In</a>
    </div>
    <form method="post">
        <label for='nombre_usuario'>Nombre:</label></br>
        <input type="text" name="nombre_usuario" required><br>
        <label for='clave'> contraseña</label></br>
        <input type="password" name="clave" required><br>
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