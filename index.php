<?php
session_start();

// Verifica se o usuário está logado (você pode ajustar isso de acordo com sua lógica de login)
if (!isset($_SESSION['usuario'])) {
    // Se o usuário não está logado, redirecione para a página de login
    header("Location: login.php");
    exit(); // Sempre chame exit após o redirecionamento
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibição de Tópicos</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="container">
        <div class="grids">
            <?php
            // Carregar os dados do arquivo JSON
            $arquivo_json = 'dados.json';
            if (file_exists($arquivo_json)) {
                $json_data = file_get_contents($arquivo_json);
                $dados = json_decode($json_data, true);

                // Exibir cada tópico em uma grid
                foreach ($dados as $index => $topico) {
                    echo '<div class="grid-item">';
                    echo '<h3>' . htmlspecialchars($topico['nome']) . '</h3>';
                    echo '<p>' . htmlspecialchars($topico['descricao']) . '</p>';
                    
                    // Verifica e exibe a imagem da pasta uploads/
                    $imagem = 'uploads/' . basename($topico['imagem']);
                    echo '<img src="' . htmlspecialchars($imagem) . '" alt="Imagem do Tópico">';

                    // Adicionar um botão de editar para cada grid
                    echo '<a href="editar.php?id=' . $index . '" class="btn-editar">Editar</a>';

                    echo '</div>';
                }
            } else {
                echo '<p>Nenhum tópico encontrado.</p>';
            }
            ?>
        </div>
        <a href="cadastro_topico.php" class="btn-cadastro">Cadastrar Novo Tópico</a>
        <a href="sobre.php" class="btn-sobre">Sobre</a>
    </div>
</body>
</html>
