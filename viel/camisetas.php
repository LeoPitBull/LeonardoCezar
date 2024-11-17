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
        $imagem_nome = $imagem['name'];  // Nome original da imagem
        $imagem_temp = $imagem['tmp_name']; // Caminho temporário da imagem
        $imagem_tipo = $imagem['type'];  // Tipo da imagem
        
        // Verifica se o arquivo é uma imagem
        $extensao = pathinfo($imagem_nome, PATHINFO_EXTENSION);  // Obtém a extensão do arquivo
        $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($extensao), $extensoes_permitidas)) {
            // Define o diretório para salvar a imagem
            $diretorio = 'img/';
            if (!file_exists($diretorio)) {
                mkdir($diretorio, 0777, true);
            }
            
            // O nome final da imagem será o nome original do arquivo
            $imagem_nome_final = $imagem_nome;  // Usando o nome original
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

    // Passa os parâmetros para a consulta
    $stmt->bind_param("sssssss", $cor, $tamanho, $quantidade, $valor, $descricao, $material, $caminho_imagem);

    // Executa a consulta
    if ($stmt->execute()) {
        echo "Camiseta cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar camiseta: " . $stmt->error;
    }

    // Fecha a consulta
    $stmt->close();
}

// Fecha a conexão
$conexao->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="camisetas.css">
    <title>Cadastro Produtos</title>
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
        <a href="adm.php">Voltar</a>
    </div>
</header>
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
    <input type="file" id="imagem" name="imagem" accept="img/*"><br>

    <input type="submit" value="Cadastrar">
</form>
</body>
</html>
