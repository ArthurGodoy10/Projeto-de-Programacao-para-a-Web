<?php
session_start();
    if (isset($_SESSION['id_usuario'])){
        if (!isset($_COOKIE['pontuacao_user'])){
            getUserRecord();
            print_r($_COOKIE['pontuacao_user']);
        } else {
        header("location: areaPrivada.php");
        }
    } else {
        header("location: index.php");
    }

function getUserRecord()
{
    $user = $_SESSION['id_usuario'];
    include("conexaobd.php");

    $pontuacao = getRecord($user);
    print_r($pontuacao);

    setcookie('pontuacao_user', $pontuacao);
}
