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

echo "Conectado com sucesso ao banco de dados!";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexão com Banco de Dados</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="img/logo.png">
</head>
<body>

</body>
</html>