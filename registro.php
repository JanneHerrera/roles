<?php
include 'db.php';
include 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $clave = $_POST['clave'];
    $rol_id = $_POST['rol_id'];

    $clave_hash = encriptarClave($clave);

    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, clave, rol_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $nombre_usuario, $clave_hash, $rol_id);

    if ($stmt->execute()) {
        echo "Usuario registrado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

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