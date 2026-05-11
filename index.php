<?php
    //Declarando as configurações para conexão com o banco de dados
    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "meu_sistema";

    $conn = mysqli_connect($host, $usuario, $senha, $banco);

    //Se der algum problema de conexão, o site não passa daqui
    if (!$conn){
        die("Falha ao se conectar com um banco de dados ". mysqli_error());
    }

    //Variável que usaremos mais tarde
    $mensagem = "";

    //Aqui, apenas pegamos os dados inseridos quando aperta o botão
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $username = $_POST['username'];
        //Criptografando a senha
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (email, username, senha) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $email, $username, $senha);
        if(mysqli_execute($stmt)){
            $mensagem = "Conta criada com sucesso!";
        } else{
            $mensagem = "Falha ao tentar criar a conta";
        }

        mysqli_close($stmt);
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
    <h2>Criar Nova Conta</h2>
    <form action="index.php" method="POST">
        <input type="email" name="email" placeholder="Seu email" required><br><br>
        <input type="text" name="username" placeholder="Seu username" required><br><br>
        <input type="password" name="senha" placeholder="Sua senha" required><br><br>
        <button type="submit">Cadastrar</button>
    </form>
    <?php
        if ($mensagem != ""){
            echo "<p><strong>$mensagem</strong></p>";
        }
    ?>
</body>
</html>