<?php
// Verificar o ID passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Carregar os dados do arquivo JSON
    $arquivo_json = 'dados.json';
    if (file_exists($arquivo_json)) {
        $json_data = file_get_contents($arquivo_json);
        $dados = json_decode($json_data, true);

        // Verificar se o ID é válido
        if (isset($dados[$id])) {
            $topico = $dados[$id];

            // Se o formulário foi enviado
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Atualizar os dados do tópico com as novas informações
                $dados[$id]['nome'] = htmlspecialchars($_POST['nome']);
                $dados[$id]['descricao'] = htmlspecialchars($_POST['descricao']);

                // Salvar os dados atualizados no arquivo JSON
                file_put_contents($arquivo_json, json_encode($dados, JSON_PRETTY_PRINT));

                echo 'Tópico atualizado com sucesso!';
                // Redirecionar de volta para a página principal
                header('Location: index.php');
                exit();
            }
        } else {
            echo 'Tópico não encontrado.';
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tópico</title>
    <link rel="stylesheet" href="css/editar.css">
</head>
<body>
    <h2>Editar Tópico</h2>
    <form action="editar.php?id=<?php echo $id; ?>" method="post">
        <label for="nome">Nome do Tópico:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($topico['nome']); ?>" required>
        <br>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required><?php echo htmlspecialchars($topico['descricao']); ?></textarea>
        <br><br>
        <input type="submit" value="Salvar Alterações">
    </form>
</body>
</html>
