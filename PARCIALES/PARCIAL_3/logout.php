<?php
session_start();
session_destroy(); // Destruir la sesión
header('Location: autenticacion.php');
exit;
?>