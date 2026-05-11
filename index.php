<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "empresa_db";

// 1. Criando a conexão
$conexao = mysqli_connect($host, $usuario, $senha, $banco);

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 2. Capturando os dados
    $nome = $_GET['nome_completo'];
    $email = $_POST['email'];
    
    $senha_segura = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // 3. Preparando para o Banco
    $sql = "INSERT INTO funcionarios (nome_completo, email, senha) VALUES (?, ?)";
    
    $stmt = mysqli_prepare($conexao, $sql);

    // 4. Injetando os dados
    mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $_POST['senha']);

    // 5. Executando
    if (mysqli_stmt_execute($sql)) {
        echo "Funcionário cadastrado!";
    } 

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>
<body>
    <form action="cadastro.php" method="POST">
        <input type="text" name="nome_completo" placeholder="Nome">
        <input type="email" name="email" placeholder="E-mail">
        <input type="password" name="senha" placeholder="Senha">
        <button type="submit">Cadastrar Funcionário</button>
    </form>
</body>
</html>