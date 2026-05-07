<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "meu_sistema";

$conn = mysqli_connect($host, $usuario, $senha, $banco);

// Verificar se houve erro
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $user = $_POST['username'];
    $pass = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (email, username, senha) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $email, $user, $pass);
    if (mysqli_stmt_execute($stmt)) {
        $mensagem = "Usuário cadastrado com suscesso";
    } else {
        $mensagem = "Erro ao cadastrar: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexão com Banco de Dados</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="img/logo.png">
</head>
<body>
    <div class="container">
        <h2>Criar uma Conta</h2>
        <?php  ?>
    </div>
</body>
</html>
