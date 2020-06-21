<?php
session_start();
if (isset($_SESSION['id_usuario'])) {
    header("location: areaPrivada.php");
} else { header("location: index.php");
    exit;
}
?>