<?php
function encriptarClave($clave) {
    return password_hash($clave, PASSWORD_ARGON2ID);
}

function verificarClave($clave, $clave_hash) {
    return password_verify($clave, $clave_hash);
}
?>