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

    // Prepara e executa a consulta SQL
    $sql = "INSERT INTO camisetas (cor, tamanho, quantidade, valor, descricao, material) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    if (!$stmt) {
        die("Erro ao preparar a consulta: " . $conexao->error);
    }

    $stmt->bind_param("ssssss", $cor, $tamanho, $quantidade, $valor, $descricao, $material);

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
    <form action="camisetas.php" method="post">
        <label for="cor">Cor:</label>
        <select id="cor" name="cor">
            <option value="preto">Preto</option>
            <option value="cinza">Cinza</option>
            <option value="off-white">Off-White</option>
        </select>

        <label for="tamanho">Tamanho:</label>
        <select id="tamanho" name="tamanho">
            <option value="P">P</option>
            <option value="M">M</option>
            <option value="G">G</option>
            <option value="GG">GG</option>
        </select>

        <label for="quantidade">Quantidade:</label>   

        <input type="number" id="quantidade" name="quantidade" required>

        <label for="valor">Valor:</label>
        <input type="number" id="valor" name="valor" step="0.01" required>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"></textarea>   


        <label for="material">Material:</label>
        <input type="text" id="material" name="material" maxlength="50">

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
