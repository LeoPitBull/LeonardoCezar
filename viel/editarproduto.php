<?php
include_once('config.php');

// Verifica se o parâmetro 'id' foi enviado via GET
if (isset($_GET['id'])) {
    // Sanitiza o id para evitar injeção de SQL
    $id = mysqli_real_escape_string($conexao, $_GET['id']);

    // Prepara a consulta SQL utilizando prepared statements
    $sql = "SELECT * FROM camisetas WHERE id=?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);

    // Executa a consulta
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Obtém os dados da camiseta
            $camiseta_data = $result->fetch_assoc();

            // Atribui os valores aos campos
            $id = $camiseta_data['id'];
            $cor = $camiseta_data['cor'];
            $tamanho = $camiseta_data['tamanho'];
            $quantidade = $camiseta_data['quantidade'];
            $valor = $camiseta_data['valor'];
            $descricao = $camiseta_data['descricao'];
            $material = $camiseta_data['material'];
            $imagem = $camiseta_data['imagem'];
        } else {
            echo "Camiseta não encontrada.";
            exit;
        }
    } else {
        echo "Erro ao executar a consulta: " . $stmt->error;
        exit;
    }

    // Fecha o statement
    $stmt->close();
} else {
    header('Location: listaproduto.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="camisetas.css">
    <title>Editar Produtos</title>
    <style>

* {
            margin: 0;
            padding: 0;
        }

        header {
    background-color: white;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.viel h2 {
    max-width: 100%;
    height: auto;
    max-height: 100px; /* Defina a altura máxima desejada */
    text-align: center;
}

.viel a {
    text-decoration: none; /* Remove o sublinhado padrão */
    color: inherit; /* Herda a cor do texto padrão */
}

.viel a:hover {
    text-decoration: none; /* Remove o sublinhado ao passar o mouse */
    color: inherit; /* Mantém a cor do texto ao passar o mouse */
}

h1{
    text-align: center;
}

.menu {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
        }

        .menu a {
            color: var(--black);
            text-decoration: none;
            font-size: 18px;
        }

        .menu a:hover{
            color: red;
        }

 /* Container do formulário */
 form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        /* Estilo dos labels */
        label {
            font-weight: 500;
            font-size: 1rem;
            color: #333;
            margin-bottom: 8px;
            display: inline-block;
        }

        /* Estilo dos inputs e textarea */
        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 95%;
            padding: 12px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            transition: all 0.3s ease-in-out;
        }

        /* Estilo de foco nos campos */
        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        input[type="file"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        /* Estilo do botão de submit */
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Estilo do botão ao passar o mouse */
        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Ajustes para dispositivos móveis */
        @media (max-width: 768px) {
            form {
                padding: 15px;
                width: 90%;
            }
        }
    </style>
    </style>
</head>
<body>
<header> 
     <div class="viel">
      <a href="index.php">
      <h2>viɘl</h2>
      </a>
    </div>
      
      <div class="menu">
        <a href="listaproduto.php">Voltar</a>
    </div>
</header>
<h1>Alterar Camisetas</h1>
<form action="salvarProdutos.php" method="POST">
    <label for="cor">Cor:</label>
    <input type="text" name="cor" value="<?php echo htmlspecialchars($cor); ?>" required><br>

    <label for="tamanho">Tamanho:</label>
    <input type="text" name="tamanho" value="<?php echo htmlspecialchars($tamanho); ?>" required><br>

    <label for="quantidade">Quantidade:</label>
    <input type="number" name="quantidade" value="<?php echo htmlspecialchars($quantidade); ?>" required><br>

    <label for="valor">Valor:</label>
    <input type="text" name="valor" value="<?php echo htmlspecialchars($valor); ?>" required><br>

    <label for="descricao">Descrição:</label>
    <textarea name="descricao" required><?php echo nl2br(htmlspecialchars($descricao)); ?></textarea><br>

    <label for="material">Material:</label>
    <input type="text" name="material" value="<?php echo htmlspecialchars($material); ?>" required><br>

    <label for="imagem">Imagem do Produto:</label>
    <input type="file" id="imagem" name="imagem" accept="img/*"><br>

    <input type="submit" name="update" id="update" value="Atualizar">
</form>
</body>
</html>
