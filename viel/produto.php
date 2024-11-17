<?php
// Verifique se o ID do produto foi passado
if (isset($_GET['id'])) {
   include_once('config.php');
    $productId = intval($_GET['id']); // Obtém o ID do produto da URL

    // Consulta ao banco de dados para pegar os detalhes do produto
    $sql = "SELECT * FROM camisetas WHERE id = $productId";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc(); // Pega os detalhes do produto

        // Exibe os detalhes do produto (como nome, descrição, imagem, etc.)
        echo "<h1>" . htmlspecialchars($product['cor']) . " - " . htmlspecialchars($product['tamanho']) . "</h1>";
        echo "<img src='" . htmlspecialchars($product['imagem']) . "' alt='Imagem do produto'>";
        echo "<p><strong>Descrição:</strong> " . nl2br(htmlspecialchars($product['descricao'])) . "</p>";
        echo "<p><strong>Material:</strong> " . htmlspecialchars($product['material']) . "</p>";
        echo "<p><strong>Quantidade:</strong> " . htmlspecialchars($product['quantidade']) . "</p>";
        echo "<p><strong>Preço:</strong> R$ " . number_format($product['valor'], 2, ',', '.') . "</p>";
    } else {
        echo "<p>Produto não encontrado.</p>";
    }

    // Fechar a conexão
    $conexao->close();
} else {
    echo "<p>ID de produto não fornecido.</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <style>
        /* Resetando margens e padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Definindo o estilo geral da página */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        /* Container principal */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* Estilos para o título do produto */
        h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Estilo da imagem do produto */
        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Container de detalhes do produto */
        .product-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* Estilo dos parágrafos e labels */
        p {
            font-size: 1rem;
            color: #555;
        }

        strong {
            font-weight: bold;
            color: #333;
        }

        /* Estilo do preço */
        .product-price {
            font-size: 1.5rem;
            color: #e74c3c;
            font-weight: bold;
        }

        /* Botão de voltar */
        .back-button {
            text-decoration: none;
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 1rem;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #2980b9;
        }

        /* Estilos responsivos */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                padding: 10px;
            }

            .product-details {
                gap: 10px;
            }

            h1 {
                font-size: 1.5rem;
            }

            .product-price {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>

<!-- Container de conteúdo -->
<div class="container">
    <!-- Detalhes do produto -->
    <div class="product-details">
        <!-- Título do produto -->
        <h1><?php echo htmlspecialchars($product['cor']) . " - " . htmlspecialchars($product['tamanho']); ?></h1>

        <!-- Imagem do produto -->
        <img src="<?php echo htmlspecialchars($product['imagem']); ?>" alt="Imagem do produto" class="product-image">

        <!-- Descrição do produto -->
        <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($product['descricao'])); ?></p>
        <p><strong>Material:</strong> <?php echo htmlspecialchars($product['material']); ?></p>
        <p><strong>Quantidade:</strong> <?php echo htmlspecialchars($product['quantidade']); ?></p>
        <p class="product-price"><strong>Preço:</strong> R$ <?php echo number_format($product['valor'], 2, ',', '.'); ?></p>

        <!-- Botão de voltar -->
        <a href="listacamisetas.php" class="back-button">Voltar</a>
    </div>
</div>

</body>
</html>

