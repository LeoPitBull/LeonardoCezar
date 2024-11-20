<?php
session_start();
include_once('config.php');

$nome = $email = $senha = $telefone = $endereco = $cidade = $estado = $tipo = $cpf = '';

// Verifica se o parâmetro 'cpf' foi enviado via GET
if (isset($_GET['cpf'])) {
    // Sanitiza o cpf para evitar injeção de SQL
    $cpf = $_GET['cpf'];

    // Prepara a consulta SQL utilizando prepared statements
    $sql = "SELECT * FROM clientes WHERE cpf=?";
    if ($stmt = $conexao->prepare($sql)) {
        $stmt->bind_param("s", $cpf); // "s" para string
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Obtém os dados do cliente
            $user_data = $result->fetch_assoc();

            // Atribui os valores aos campos do formulário
            $nome = $user_data['nome'];
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
        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $conexao->error;
        exit;
    }
}


// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber os dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_SESSION['cpf'];  // Assume-se que o CPF esteja salvo na sessão
    $email = $_POST['email'];
    $senha = $_POST['senha']; // Senha já está como hidden
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $pagamento = $_POST['pagamento'];
    $numero_cartao = $_POST['numero_cartao'] ?? null; // Se for cartão de crédito
    $data_validade = $_POST['data_validade'] ?? null;
    $codigo_seguranca = $_POST['codigo_seguranca'] ?? null;

    // Inserir os dados na tabela "pedidos"
    $sql = "INSERT INTO pedidos (nome, cpf_cliente, email, senha, telefone, endereco, cidade, estado, pagamento, numero_cartao, data_validade, codigo_seguranca)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conexao->prepare($sql)) {
        // Vincular os parâmetros ao statement
        $stmt->bind_param("ssssssssssss", $nome, $cpf, $email, $senha, $telefone, $endereco, $cidade, $estado, $pagamento, $numero_cartao, $data_validade, $codigo_seguranca);
        
        // Executar a inserção
        if ($stmt->execute()) {
            echo "Pedido registrado com sucesso!";
        } else {
            echo "Erro ao registrar o pedido: " . $stmt->error;
        }

        // Fechar o statement
        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $conexao->error;
    }

    // Após o processamento, redireciona para a página com o alert
    echo "<script>
        alert('Compra Finalizada!');
        window.location.href = 'index.php'; // Ou qualquer página que você queira redirecionar
    </script>";
    exit;
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra</title>
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
            font-size: 18px;
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

/* Estilos gerais */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7f6;
    margin: 0;
    padding: 20px;
}

/* Estilo específico para o select de pagamento */
#pagamento {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    background-color: #fff;
    color: #555;
    cursor: pointer;
    transition: border-color 0.3s;
}

/* Efeito de foco para o select de pagamento */
#pagamento:focus {
    border-color: black;
    outline: none;
}

/* Estilo específico para os campos de cartão de crédito/débito */
.payment-details input,
.payment-details select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    box-sizing: border-box;
    transition: border-color 0.3s;
}

/* Efeito de foco para os campos de cartão de crédito/débito */
.payment-details input:focus,
.payment-details select:focus {
    border-color: black;
    outline: none;
}

/* Estilo do container dos detalhes do pagamento */
.payment-details {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
    display: none;
}

.payment-details.active {
    display: block;
}

/* Estilo dos rótulos específicos */
.payment-details label {
    display: block;
    font-weight: bold;
    margin-bottom: 8px;
    color: #333;
}

/* Estilo do botão de envio */
button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}

button:hover {
    background-color: #45a049;
}


/* Responsividade */
@media (max-width: 768px) {
    body {
        padding: 10px;
    }

    .payment-details {
        padding: 15px;
    }
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

        .payment-details {
            display: none; /* Inicialmente oculto */
        }
    </style>
</head>
<body>

<header>
    <h1>viɘl</h1>
</header>

<div class="form-container">
    <h2>Finalizar Compra</h2>
    <form action="checkout.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>

        <label for="email">E-mail:</label>
        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required >

        <!-- A senha é protegida e não será visível no formulário -->
        <input type="hidden" id="senha" name="senha" value="<?php echo htmlspecialchars($senha); ?>" required>

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

        <!-- Campo de seleção de forma de pagamento -->
        <label for="pagamento">Forma de Pagamento:</label>
        <select id="pagamento" name="pagamento" required onchange="togglePaymentDetails()">
            <option value="" disabled selected>Escolha a forma de pagamento</option>
            <option value="credito">Cartão de Crédito</option>
            <option value="debito">Cartão de Débito</option>
        </select>

        <div id="credit-card-details" class="payment-details">
            <label for="numero_cartao">Número do Cartão:</label>
            <input type="text" id="numero_cartao" name="numero_cartao" placeholder="Número do cartão" maxlength="16" required>

            <label for="data_validade">Data de Validade:</label>
            <input type="text" id="data_validade" name="data_validade" placeholder="MM/AA" required>

            <label for="codigo_seguranca">Código de Segurança (CVV):</label>
            <input type="text" id="codigo_seguranca" name="codigo_seguranca" placeholder="CVV" required>
        </div>

        <input type="hidden" name="cpf" value="<?php echo htmlspecialchars($cpf); ?>">
        <input type="submit" name="update" value="Finalizar">
    </form>
    <a href="carrinho.php" class="back-link">Voltar</a>
</div>

<script>
    // Função para mostrar ou ocultar os campos de dados do cartão com base na escolha do pagamento
    function togglePaymentDetails() {
        var pagamento = document.getElementById("pagamento").value;
        var creditCardDetails = document.getElementById("credit-card-details");

        if (pagamento === "credito" || pagamento === "debito") {
            creditCardDetails.style.display = "block";
        } else {
            creditCardDetails.style.display = "none";
        }
    }
</script>

</body>
</html>
