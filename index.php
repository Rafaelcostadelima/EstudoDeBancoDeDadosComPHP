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
        <?php if($mensagem != ""): ?>
    </div>
</body>
</html>