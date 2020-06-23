<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: index.php");
    exit;
}
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Jump Game</title>
    <link rel="stylesheet" href="css/index.css" />
</head>

<body>
    <h1>Welcome</h1>
    <a href="sair.php"> Sair </a>
    <span id="span">fsfsd</span>
    <script src="JS/index.js"></script>
</body>

</html>