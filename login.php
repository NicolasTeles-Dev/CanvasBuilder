<?php
session_start();

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['pass'];

    // Aqui você pode verificar as credenciais no banco de dados ou em um arquivo
    // Para simplificação, vamos usar um exemplo com valores fixos
    $email_correto = 'admin@gmail.com';
    $senha_correta = '12345'; // Senha fixa para o exemplo

    // Verificar se o e-mail e a senha correspondem aos valores corretos
    if ($email === $email_correto && $senha === $senha_correta) {
        // Se as credenciais estiverem corretas, definir uma sessão para o usuário
        $_SESSION['usuario'] = $email;

        // Redirecionar para a página inicial (index.php)
        header("Location: index.php");
        exit();
    } else {
        // Se as credenciais estiverem incorretas, exibir uma mensagem de erro
        $erro = "E-mail ou senha incorretos. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="nav">
        <p class="text">Bem vindo, realize o login</p>
    </div>
    <div class="container">
        <!-- Exibir mensagem de erro se houver -->
        <?php if (isset($erro)): ?>
            <p style="color:red;"><?php echo htmlspecialchars($erro); ?></p>
        <?php endif; ?>

        <form class="form" action="login.php" method="post">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="seuemail@gmail.com" required>
            <br>
            <label for="pass">Senha</label>
            <input type="password" name="pass" id="pass" placeholder="********" required>
            <br><br><br><br>
            <input class="butao" type="submit" value="Entrar">
        </form>
    </div>
</body>
</html>
