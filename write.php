<?php
session_start();
include('db.php');

if ($_SESSION['rol_id'] !== 1 || $_SESSION['rol_id'] !== 3) {
    echo "<script>
    alert('¿Usted qué hace aquí? No tiene permisos para esto');
    window.location.href = './logout.php';
    </script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
    $usuario_id = $_POST['usuario_id'];
    $nuevo_nombre = $_POST['nuevo_nombre'];
    $nuevo_rol = $_POST['nuevo_rol'];

    $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, rol = ? WHERE id = ?");
    $stmt->bind_param("sii", $nuevo_nombre, $nuevo_rol, $usuario_id);

    if ($stmt->execute()) {
        echo "<script>alert('Usuario actualizado exitosamente.');</script>";
    } else {
        echo "<script>alert('Error al actualizar el usuario.');</script>";
    }

    $stmt->close();
}

$result = $conexion->query("
    SELECT usuarios.id AS usuario_id, usuarios.nombre AS usuario_nombre, roles.nombre AS rol_nombre, roles.id AS rol_id
    FROM usuarios
    INNER JOIN roles ON usuarios.rol = roles.id
");

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<form method='post' action=''>";
    echo "<input type='hidden' name='usuario_id' value='{$row['usuario_id']}'>";
    echo "<label>Nombre: </label><input type='text' name='nuevo_nombre' value='{$row['usuario_nombre']}' required>";
    echo "<label>Rol: </label>
        <select name='nuevo_rol'>";
    $roles_result = $conexion->query("SELECT * FROM roles");
    while ($rol = $roles_result->fetch_assoc()) {
        $selected = ($rol['id'] == $row['rol_id']) ? 'selected' : '';
        echo "<option value='{$rol['id']}' $selected>{$rol['nombre']}</option>";
    }
    echo "</select>";
    echo "<button type='submit' name='edit_user'>Actualizar</button>";
    echo "</form>";
    echo "<p>Rol Actual: {$row['rol_nombre']}</p>";
    echo "</div>";
}
