<?php
include_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $cor = $_POST['cor'];
    $tamanho = $_POST['tamanho'];
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];
    $descricao = $_POST['descricao'];
    $material = $_POST['material'];

    // Verifica se a imagem foi enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $imagem = $_FILES['imagem'];
        $imagem_nome = $imagem['name'];
        $imagem_temp = $imagem['tmp_name'];
        $imagem_tipo = $imagem['type'];
        
        // Verifica se o arquivo é uma imagem
        $extensao = pathinfo($imagem_nome, PATHINFO_EXTENSION);
        $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($extensao), $extensoes_permitidas)) {
            // Define o diretório para salvar a imagem
            $diretorio = 'uploads/';
            if (!file_exists($diretorio)) {
                mkdir($diretorio, 0777, true);
            }
            // Define um nome único para a imagem
            $imagem_nome_final = uniqid() . '.' . $extensao;
            $caminho_imagem = $diretorio . $imagem_nome_final;

            // Move o arquivo para o diretório de uploads
            if (move_uploaded_file($imagem_temp, $caminho_imagem)) {
                echo "Imagem enviada com sucesso!<br>";
            } else {
                echo "Erro ao enviar a imagem.<br>";
            }
        } else {
            echo "Apenas arquivos de imagem (JPG, JPEG, PNG, GIF) são permitidos.<br>";
        }
    } else {
        $caminho_imagem = null;  // Caso não tenha enviado uma imagem
    }

    // Prepara e executa a consulta SQL
    $sql = "INSERT INTO camisetas (cor, tamanho, quantidade, valor, descricao, material, imagem) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    if (!$stmt) {
        die("Erro ao preparar a consulta: " . $conexao->error);
    }

    $stmt->bind_param("sssssss", $cor, $tamanho, $quantidade, $valor, $descricao, $material, $caminho_imagem);

    if ($stmt->execute()) {
        echo "Camiseta cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar camiseta: " . $stmt->error;
    }

    $stmt->close();
}

$conexao->close();
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="camisetas.css">
    <title>Document</title>
</head>
<body>
<body>
<h1>Cadastro de Camisetas</h1>
<form action="camisetas.php" method="POST" enctype="multipart/form-data">
    <label for="cor">Cor:</label>
    <input type="text" name="cor" required><br>

    <label for="tamanho">Tamanho:</label>
    <input type="text" name="tamanho" required><br>

    <label for="quantidade">Quantidade:</label>
    <input type="number" name="quantidade" required><br>

    <label for="valor">Valor:</label>
    <input type="text" name="valor" required><br>

    <label for="descricao">Descrição:</label>
    <textarea name="descricao" required></textarea><br>

    <label for="material">Material:</label>
    <input type="text" name="material" required><br>

    <label for="imagem">Imagem do Produto:</label>
    <input type="file" name="imagem" accept="image/*"><br>

    <input type="submit" value="Cadastrar">
</form>
</body>
</html>
