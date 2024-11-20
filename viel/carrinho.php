<?php
session_start(); // Iniciar a sessão
include_once('config.php');

// Verificar se o usuário está logado
$cpf = $_SESSION['cpf'] ?? null;
if (!$cpf) {
    header("Location: login.php");
    exit();
}

// Função para verificar se um item foi adicionado ao carrinho
function adicionarAoCarrinho($id_produto, $quantidade) {
    global $conexao;

    // Sanitização e validação
    $id_produto = filter_var($id_produto, FILTER_VALIDATE_INT);
    $quantidade = filter_var($quantidade, FILTER_VALIDATE_INT);
    
    if ($quantidade <= 0) {
        return; // Evita adicionar quantidade inválida
    }

    // Verificar se o produto já existe no carrinho
    if (isset($_SESSION['carrinho'][$id_produto])) {
        $_SESSION['carrinho'][$id_produto]['quantidade'] += $quantidade;
    } else {
        // Se não, buscar as informações do produto
        $sql = "SELECT id, cor, tamanho, imagem, valor FROM camisetas WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('i', $id_produto);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $produto = $result->fetch_assoc();
            $_SESSION['carrinho'][$id_produto] = [
                'id_produto' => $produto['id'],
                'cor' => $produto['cor'],
                'tamanho' => $produto['tamanho'],
                'imagem' => $produto['imagem'],
                'valor' => $produto['valor'],
                'quantidade' => $quantidade
            ];
        }
    }
}

// Função para atualizar a quantidade do produto no carrinho
function atualizarQuantidade($id_produto, $quantidade) {
    if (isset($_SESSION['carrinho'][$id_produto]) && $quantidade > 0) {
        $_SESSION['carrinho'][$id_produto]['quantidade'] = $quantidade;
    } else {
        unset($_SESSION['carrinho'][$id_produto]); // Remove o item se a quantidade for zero ou negativa
    }
}

// Função para remover o item do carrinho
function removerDoCarrinho($id_produto) {
    if (isset($_SESSION['carrinho'][$id_produto])) {
        unset($_SESSION['carrinho'][$id_produto]);
    }
}

// Adicionar produto ao carrinho
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['adicionar_ao_carrinho'])) {
        $id_produto = $_POST['id_produto'];
        $quantidade = $_POST['quantidade'];
        adicionarAoCarrinho($id_produto, $quantidade);
    }

    if (isset($_POST['atualizar_quantidade'])) {
        $id_produto = $_POST['id_produto'];
        $quantidade = $_POST['quantidade'];
        atualizarQuantidade($id_produto, $quantidade);
    }

    if (isset($_POST['remover_produto'])) {
        $id_produto = $_POST['id_produto'];
        removerDoCarrinho($id_produto);
    }
}

// Consultar os itens do carrinho da sessão
$carrinho = $_SESSION['carrinho'] ?? [];
$total = 0;
$vazio = empty($carrinho);

foreach ($carrinho as $id_produto => $item) {
    $total += $item['valor'] * $item['quantidade'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }

header {
    background-color: white;
    padding: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.viel h2 {
    max-width: 100%;
    height: auto;
    max-height: 100px; /* Defina a altura máxima desejada */
    text-align: center;
}

a {
    text-decoration: none; /* Remove o sublinhado padrão */
    color: inherit; /* Herda a cor do texto padrão */
}

a:hover {
    text-decoration: none; /* Remove o sublinhado ao passar o mouse */
    color: inherit; /* Mantém a cor do texto ao passar o mouse */
}


nav {
    background-color: white;
    padding-bottom: 20px;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    gap: 10px; /* Ajuste este valor conforme necessário */
}

nav a {
    display: block;
    padding: 14px 16px;
    text-decoration: none;
    color: black;
    border-radius: 50px;
    border: black solid 2px;
}

nav a:hover {
    background-color: black;
    color: white;
    border-radius: 50px;
}
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .carrinho {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .carrinho-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .carrinho-item img {
            max-width: 80px;
            height: auto;
            border-radius: 5px;
        }
        .carrinho-item .info {
            flex: 1;
            margin-left: 20px;
        }
        .carrinho-item .info p {
            margin: 5px 0;
        }
        .total {
            text-align: right;
            font-size: 1.2em;
            margin-top: 20px;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
        }
        .button:hover {
            background-color: #45a049;
        }
        .vazio {
            text-align: center;
            font-size: 1.2em;
            color: #888;
        }
        .remover {
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .remover:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<header>
    <div class="viel">
      <a href="index.php">
      <h2>viɘl</h2>
      </a>
    </div>
  </header>

  <!-- Navegação -->
  <nav>
    <ul class="navbar">
      <li><a href="index.php">Início</a></li>
      <li><a href="#">Categorias</a></li>
      <li><a href="tabelademedidas.html">Tabela de Medidas</a></li>
      <li><a href="contato.html">Contato</a></li>
    </ul>
  </nav>

<div class="container">
    <h1>Carrinho de Compras</h1>

    <div class="carrinho">
        <?php if ($vazio): ?>
            <p class="vazio">Seu carrinho está vazio. Adicione produtos para continuar a compra.</p>
        <?php else: ?>
            <?php foreach ($carrinho as $id_produto => $item): ?>
                <form action="" method="POST" style="margin-bottom: 15px;">
                    <div class="carrinho-item">
                        <img src="<?php echo htmlspecialchars($item['imagem']); ?>" alt="Imagem do produto">
                        <div class="info">
                            <p><strong>Produto:</strong> <?php echo htmlspecialchars($item['cor']) . " - " . htmlspecialchars($item['tamanho']); ?></p>
                            <p><strong>Preço:</strong> R$ <?php echo number_format($item['valor'], 2, ',', '.'); ?></p>
                            <p><strong>Quantidade:</strong>
                                <input type="number" name="quantidade" value="<?php echo $item['quantidade']; ?>" min="1" required>
                            </p>
                            <input type="hidden" name="id_produto" value="<?php echo $id_produto; ?>">
                            <button type="submit" name="atualizar_quantidade">Atualizar Quantidade</button>
                        </div>
                        <div class="preco">
                            <p><strong>Total:</strong> R$ <?php echo number_format($item['valor'] * $item['quantidade'], 2, ',', '.'); ?></p>
                            <button type="submit" name="remover_produto" class="remover">Remover</button>
                        </div>
                    </div>
                </form>
            <?php endforeach; ?>

            <div class="total">
                <p><strong>Total do Carrinho:</strong> R$ <?php echo number_format($total, 2, ',', '.'); ?></p>
            </div>
            <a href="checkout.php" class="button" >Finalizar Compra</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

<?php
// Fechar conexão com o banco
$conexao->close();
?>
