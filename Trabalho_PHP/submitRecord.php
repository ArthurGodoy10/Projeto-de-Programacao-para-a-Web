<?php
session_start();

if (isset($_POST['record'])) {
    $record = $_POST['record'];
    $id_usuario = $_SESSION['id_usuario'];

    include("conexaobd.php");
    inserirpontuacao($id_usuario, $record);
} else {
   header('location: areaPrivada.php');
}
