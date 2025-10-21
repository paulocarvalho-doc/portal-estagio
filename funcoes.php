<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function verificarLogin() {
    if(!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit;
    }
}
?>
