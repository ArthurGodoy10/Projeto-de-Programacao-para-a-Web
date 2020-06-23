<?php
include('usuarios.php');
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body id="cadastrar">
    <div id="corpo-form">
        <h1>Cadastrar</h1>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome Completo" maxlength="50">
            <input type="email" name="email" placeholder="Username" maxlength="50">
            <input type="password" name="senha" placeholder="Senha" maxlength="30">
            <input type="password" name="confsenha" placeholder="Confirmar Senha" maxlength="30">
            <input type="submit" value="Cadastrar">
            <a href="index.php">Já é inscrito?<strong>Conecte-se</strong></a>

        </form>
    </div>
    <?php
    //verificar se clicou no botao
    if (isset($_POST['nome'])) {
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $confirmarSenha = addslashes($_POST['confsenha']);
        //verificar se esta preenchido

        if (!empty($nome) && !empty($email) && !empty($senha) && !empty($confirmarSenha)) {
            if ($senha == $confirmarSenha) {
                if (cadastrar($nome, $email, $senha)) {
    ?>
                    <div id="msg-sucesso">
                        Cadastrado com sucesso! Acesse para entrar!
                    </div>
                <?php
                } else {
                ?>
                    <div class="msg-erro">
                        Email já Cadastrado!
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="msg-erro">
                    Senha e confirmar senha não correspondem!
                </div>
            <?php
            }
        } else {
            ?>
            <div class="msg-erro">
                Preencha todos os campos!
            </div>
    <?php
        }
    }
    ?>
</body>

</html>