<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;

    // Verifica se o arquivo é uma imagem
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Arquivo não é uma imagem.";
        $uploadOk = 0;
    }

    if ($_FILES["image"]["error"] != 0) {
        echo "Erro ao fazer o upload: " . $_FILES["image"]["error"];
        die(); // Interrompe o script para que possamos ver o erro.
    }    

    // Se o upload foi bem-sucedido
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "Arquivo enviado com sucesso para: " . $target_file;

            // Sucesso no upload da imagem
            $arquivo_json = 'dados.json';

            // Carregar os dados existentes em JSON
            if (file_exists($arquivo_json)) {
                $json_data = file_get_contents($arquivo_json);
                $dados = json_decode($json_data, true);
                
                // Se json_decode falhar, inicialize $dados como um array vazio
                if ($dados === null && json_last_error() !== JSON_ERROR_NONE) {
                    $dados = array();
                }
            } else {
                $dados = array();
            }

            // Adicionar novos dados
            $dados[] = array(
                'nome' => htmlspecialchars($_POST['name']),
                'descricao' => htmlspecialchars($_POST['desc']),
                'imagem' => $target_file
            );

            // Codificar em JSON e salvar no arquivo
            $json_data = json_encode($dados, JSON_PRETTY_PRINT);

            // Verificar se a escrita no arquivo foi bem-sucedida
            if (file_put_contents($arquivo_json, $json_data) === false) {
                echo "Desculpe, houve um erro ao salvar os dados no arquivo JSON.";
                exit();
            }

            header("Location: index.php"); // Redireciona após o sucesso
            exit();
        } else {
            echo "Desculpe, houve um erro ao fazer o upload do arquivo.";
        }
    }
}
?>
