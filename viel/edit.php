<?php
include_once('config.php');

// Verifica se o parâmetro 'cpf' foi enviado via GET
if (isset($_GET['cpf'])) {
    // Sanitiza o cpf para evitar injeção de SQL
    $cpf = mysqli_real_escape_string($conexao, $_GET['cpf']);

    // Prepara a consulta SQL utilizando prepared statements
    $sql = "SELECT * FROM clientes WHERE cpf=?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $cpf);

    // Executa a consulta
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Obtém os dados do cliente
            $user_data = $result->fetch_assoc();

            // Atribui os valores aos campos do formulário
            $nome = $user_data['nome'];
            $cpf = $user_data['cpf'];
            $email = $user_data['email'];
            $senha = $user_data['senha'];
            $telefone = $user_data['telefone'];
            $endereco = $user_data['endereco'];
            $cidade = $user_data['cidade'];
            $estado = $user_data['estado'];
            $tipo = $user_data['tipo'];
        } else {
            echo "Usuário não encontrado.";
            exit;
        }
    } else {
        echo "Erro ao executar a consulta: " . $stmt->error;
        exit;
    }

    // Fecha o statement
    $stmt->close();
} else {
    header('Location: listacliente.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Resetando margens e padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fb;
            color: #2d3436;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        header {
            background-color: #007bff;
            color: #fff;
            width: 100%;
            padding: 20px 0;
            text-align: center;
            position: absolute;
            top: 0;
            z-index: 10;
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 2px;
            margin: 0;
        }

        .form-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 650px;
            padding: 40px;
            margin-top: 80px;
            box-sizing: border-box;
        }

        .form-container h2 {
            font-size: 1.8rem;
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            font-weight: 600;
            color: #333;
            font-size: 1.1rem;
        }

        input,
        select {
            padding: 12px 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 1rem;
            color: #333;
            transition: all 0.3s ease;
        }

        input:focus,
        select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 15px;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            font-size: 1rem;
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* Estilos para dispositivos móveis */
        @media (max-width: 768px) {
            .form-container {
                padding: 25px;
                width: 90%;
            }

            header h1 {
                font-size: 1.5rem;
            }
        }

    </style>
</head>
<body>

<header>
    <h1>viɘl</h1>
</header>

<div class="form-container">
    <h2>Editar Cliente</h2>
    <form action="saveEdit.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>

        <label for="email">E-mail:</label>
        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required readonly>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" value="<?php echo htmlspecialchars($senha); ?>" required>

        <label for="telefone">Telefone:</label>
        <input type="tel" id="telefone" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>" required>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($endereco); ?>" required>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" value="<?php echo htmlspecialchars($cidade); ?>" required>

        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="" disabled>Selecione o estado</option>
            <option value="PR" <?php echo ($estado == 'PR') ? 'selected' : ''; ?>>Paraná</option>
            <option value="RJ" <?php echo ($estado == 'RJ') ? 'selected' : ''; ?>>Rio de Janeiro</option>
            <option value="MG" <?php echo ($estado == 'MG') ? 'selected' : ''; ?>>Minas Gerais</option>
        </select>

        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" required>
            <option value="0" <?php echo ($tipo == '0') ? 'selected' : ''; ?>>Usuário</option>
            <option value="1" <?php echo ($tipo == '1') ? 'selected' : ''; ?>>Admin</option>
        </select>

        <input type="hidden" name="cpf" value="<?php echo $cpf; ?>">
        <input type="submit" name="update" value="Atualizar">
    </form>
    <a href="listacliente.php" class="back-link">Voltar</a>
</div>

</body>
</html>
