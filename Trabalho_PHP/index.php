<?php
include('Classes/usuarios.php');
$u = new Usuario;

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body id="login">
    <div id="corpo-form">
        <h1>Entrar</h1>
        <form method="POST">
            <input type="email" name="email" placeholder="Usuário">
            <input type="password" name="senha" placeholder="Senha">
            <input type="submit" value="ACESSAR">
            <a href="cadastrar.php">Ainda não é inscrito?<strong>Cadastre-se</strong>
        </form>
    </div>
    <?php
    if (isset($_POST['email'])) {
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        //verificar se esta preenchido

        if (!empty($email) && !empty($senha)) {
            $u->conectar("localhost", "projeto_php", "root", "suasenha");
            if ($u->msgErro == "") {
                if ($u->logar($email, $senha)) {
                    header("location: areaPrivada.php");
                } else {
                    ?>
                    <div class="msg-erro">
                        Email e/ou senha estão incorretos!
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="msg-erro">
                    <?php echo "Erro: " . $u->msgErro; ?>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="msg-erro">
                Preencher todos os campos!
            </div>
            <?php
        }
    }
?>
</body>
</html>