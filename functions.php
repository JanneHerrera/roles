<?php
function encriptarClave($clave) {
    return password_hash($clave, PASSWORD_BCRYPT);
}

function verificarClave($clave, $clave_hash) {
    return password_verify($clave, $clave_hash);
}
?>