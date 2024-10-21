<?php
session_start();
include 'db.php';
include 'functions.php';
require_once('navBar.php');
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
        $stmt = $conexion->prepare("SELECT nombre FROM roles WHERE id = ?");
        $stmt->bind_param("i", $rol_id);
        $stmt->execute();
        $stmt->bind_result($rol);
        $stmt->fetch();
        $stmt->close();
        header("Location: dashboard.php");
    } else {
        header("login.php");
        echo "Nombre de usuario o contraseña incorrectos.</br>";
    }
}
?>

<body>

    <div class="navbar">
        <a href="./login.php">Login</a>
        <a href="./registro.php">Sign In</a>
    </div>
    <form method="post" action="login.php">
        <label for='nombre_usuario'>Nombre:</label></br>
        <input type="text" name="nombre_usuario" required><br>
        <label for='clave'> contraseña</label></br>
        <input type="password" name="clave" required><br>
        <input type="submit" value="Iniciar sesión">
    </form>


</body>

</html>