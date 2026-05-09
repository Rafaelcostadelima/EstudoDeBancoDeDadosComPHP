<?php
// Aqui, estamos preparando o ambiente para poder acessar o banco de dados
$host = "localhost"; //Padrão do XAMPP
$usuario = "root"; //Usuário padrão do XAMPP
$senha = ""; //Senha padrão do XAMPP
$banco = "meu_sistema"; //Nome escolhido para o banco de dados

$conn = mysqli_connect($host, $usuario, $senha, $banco); //Aqui é uma firmação da conexão, o banco de dados está se conectando, não basta apenas ter o $host e essas coisas

// Verifica se houve erro, caso tenha, ele indica um problema com a conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

$mensagem = ""; //Define uma mensagem em branco para usarmos mais tarde

if ($_SERVER["REQUEST_METHOD"] == "POST") { //Guardando as informações sobre o servidor e sobre quem, está acessando ele. Com este "= 'POST'" a gente delimita para fazer a ação abaixo apenas quando o método for "POST", que é quando o usuário clica no botão. Só de entrar no sie, já temos informações no método "GET", por este motivo que devemos filtrar para apenas "POST"
    $email = $_POST['email']; //Pega o que foi digitado no input com o 'name="email"'
    $user = $_POST['username']; //Pega o que foi digitado no input com o "name='username'"
    $pass = password_hash($_POST['senha'], PASSWORD_DEFAULT); //Este código criptografa a senha digitada pelo usuário
    $sql = "INSERT INTO usuarios (email, username, senha) VALUES (?, ?, ?)"; //Insira dentro da tabela de usuários. Dentro do "(email, username, senha)", indicamos a exata coluna que queremos pra onde os dados vão. O "VALUES (?, ?, ?)" serve para segurança. Com as interrogações, o PHP entende o input estritamente como um texto comum, então os hackers não conseguem burlar esse sistema
    $stmt = mysqli_prepare($conn, $sql); //Aqui, o código pede para que a conexão interceda com o banco de dados, e enviando os dados que inserimos na linha anterior. Aqui, o banco de dados já se prepara para receber os dados que entregaremos para ele nas próximas linhas
    mysqli_stmt_bind_param($stmt, "sss", $email, $user, $pass); //Aqui, o código finalmente envia os dados corretos para cada espaço reservado que codamos na linha 21. O 'sss' significa que armazenaremos 3 strings, é uma etapa final de segurança do PHP. O PHP entende que tudo o que foi colocado dentro dos valores são apenas strings, então códigos maliciosos dos hackers não terão efeito quando inseridos no formulário
    if (mysqli_stmt_execute($stmt)) { //Aqui, o código aperta o botão de salvar no banco de dados
        $mensagem = "Usuário cadastrado com suscesso"; //Caso seja salvo com sucesso, o programa vai dar esta mensagem
    } else {
        $mensagem = "Erro ao cadastrar: " . mysqli_error($conn); //Caso dê errado, vai dar esta tela
    }
    mysqli_stmt_close($stmt); //Isso quebra o "molde" e libera a memória para outros usuários
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