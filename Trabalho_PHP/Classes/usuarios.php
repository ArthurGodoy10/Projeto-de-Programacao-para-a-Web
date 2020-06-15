<?php

Class Usuario
{
    private $pdo;
    public $msgErro = "";

    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        try {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome, $email, $senha)
    {
        global $pdo;
        //verificar se já existe o email cadastrado
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            return false;// ja esta cadatrada
        }
        else
        {
             //caso não, cadatrar
             $sql = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:n, :e, :s)");
             $sql->bindValue(":n",$nome);
             $sql->bindValue(":e",$email);
             $sql->bindValue(":s",$senha);
             $sql->execute();
             return true;
        }

    }
    public function logar()
    {
        global $pdo;
        //verificar se o email e senha estao casdastrados, se sim 
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",$senha);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            //entar no sistema (sessao)
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; //llogado com sucesso
        }
        else
        {
            return false; // nao foi possivel logar
        }
    }
}
