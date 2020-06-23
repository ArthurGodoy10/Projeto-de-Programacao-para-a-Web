<?php

define('HOSTNAME',  'localhost');
define('DATABASE', 'projeto_php');
define('USERNAME', 'root');
define('SENHA', 'suasenha');

function conectar()
{
     try 
    {
    $conexao = new PDO("mysql:host=". HOSTNAME.";dbname=".DATABASE, USERNAME, SENHA);
    } 
    catch (PDOException $e) 
    {
    trigger_error($e->getMessage(), E_USER_ERROR);
    }
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $conexao;  
}

function cadastrar($nome, $email, $senha)
{
    $con = conectar();
    //verificar se já existe o email cadastrado
    $stmt = $con->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
    $stmt->execute(['e' => $email ]);

    if($stmt->rowCount() > 0)
    {
        return false;// ja esta cadatrada
    }
    else
    {
    //caso não, cadatrar
    $stmt = $con->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:n, :e, :s)");
    $stmt->execute([ 'n' => $nome, 'e' => $email, 's' => md5($senha) ]);

    $stmt = $con->prepare("INSERT INTO pontuacao (pontuacao) VALUES (:p)");
    $stmt->execute(['p' => 0]);

    return true;
    }
}

function logar($email, $senha)
{
    //verificar se o email e senha estao casdastrados, se sim 
    $con = conectar();
    $stmt = $con->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
    $stmt->execute([ 'e' => $email, 's' => md5($senha) ]);

    if($stmt->rowCount() > 0 )
    {
    //entar no sistema (sessao)
    $dado = $stmt->fetch();
    session_start();
    $_SESSION['id_usuario'] = $dado['id_usuario'];
    return true; //logado com sucesso
    }
    else
    {
    return false; // nao foi possivel logar
    echo "ERRO";
    }
}
