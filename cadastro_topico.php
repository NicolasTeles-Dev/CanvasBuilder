<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Tópico</title>
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
<div class="container">
    <div class="nav">
        <p class="text">Cadastro de novo tópico</p>
    </div>
    <form class="form" action="upload.php" method="post" enctype="multipart/form-data">
        <label for="name">Nome do tópico</label>
        <input type="text" name="name" id="name" placeholder="nome do tópico" required>
        <br><br>
        <label for="desc">Descrição</label><br>
        <textarea name="desc" id="desc" rows="4" cols="34" placeholder="descrição do tópico" required></textarea>
        <br>
        <label for="image">Imagem</label><br>
        <input type="file" name="image" id="image" accept="image/*" required>
        <br><br>
        <input class="butao" type="submit" value="Cadastrar">
    </form>
</div>
</body>
</html>
