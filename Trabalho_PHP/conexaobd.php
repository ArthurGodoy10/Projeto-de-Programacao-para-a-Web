<?php

define('HOSTNAME', 'localhost');
define('DATABASE', 'projeto_php');
define('USERNAME', 'root');
define('SENHA', 'suasenha');

function conectar()
{
    try 
    {
    $conexao = new PDO("mysql:host=".HOSTNAME.";dbname=".DATABASE, USERNAME, SENHA);
    }
    catch (PDOException $e) 
    {
    trigger_error($e->getMessage(), E_USER_ERROR);
    }
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $conexao;
}

function inserirpontuacao($id_usuario, $pontos)
{
    $con = conectar();
    $stmt = $con->prepare("UPDATE pontuacao set pontuacao = :p where id_pontuacao = :u");
    $stmt->execute(['u' => $id_usuario,'p' => $pontos]);

    header("location: areaPrivada.php");
}

function getRecord($id_usuario)
{
    $con = conectar();
    $stmt = $con->prepare("SELECT pontos FROM pontuacao WHERE id_usuario = :id_usuario");
    $stmt->execute([ 'id_usuario' => $id_usuario ]);
    $record = $stmt->fetchAll(PDO::FETCH_COLUMN);

    return $record;
}
