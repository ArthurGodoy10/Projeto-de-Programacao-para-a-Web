<?php
session_start();
session_destroy();

include('Classes/usuarios.php');

$past = time() - 3600;
foreach ($_COOKIE as $key => $value) {
    setcookie($key, $value, $past, '/');
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body id="login">
    <div id="corpo-form">
        <h1>Entrar</h1>
        <form method="POST">
            <input type="email" name="email" placeholder="Usuário" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="submit" value="ACESSAR">
            <a href="cadastrar.php">Ainda não é inscrito?<strong>Cadastre-se</strong></a>
        </form>
    </div>
    <?php

    if (isset($_POST['email'])) {
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        //verificar se esta preenchido

        if (!empty($email) && !empty($senha)) {
            if (logar($email, $senha)) {
                header("location: loginControler.php");
            } else {
    ?>
                <div class="msg-erro">
                    Email e/ou senha estão incorretos!
                </div>
    <?php
            }
        }
    }
    ?>
</body>

</html>