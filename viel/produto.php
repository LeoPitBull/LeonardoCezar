<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto Detalhes</title>
    <style>
        /* Resetando margens e paddings */
* {
    margin: 0;
    padding: 0;
}

/* Definindo a fonte e o fundo */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    color: #333;
}

header {
    background-color: white;
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.search-bar {
    display: flex;
    align-items: center;
    background-color: black; /* Cor de fundo da barra de pesquisa */
    padding: 5px;
    border-radius: 5px; /* Borda arredondada */
}

.search-bar input {
    padding: 8px;
    border: none;
    border-radius: 5px; /* Borda arredondada */
    width: 200px; /* Largura da barra de pesquisa */
    margin-right: 5px;
}

.search-bar button {
    background: none;
    border: none;
    cursor: pointer;
}

.search-bar button img {
    max-width: 20px; /* Ajuste o tamanho desejado */
    max-height: 20px; /* Ajuste o tamanho desejado */
}

.viel a {
    text-decoration: none;
    color: black;
    max-width: 100%;
    height: auto;
    max-height: 100px; /* Defina a altura máxima desejada */
    text-align: center;
}

nav {
    background-color: white;
    padding-bottom: 10px;
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

/* Estilos para o header */
.dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #fff;
            min-width: 200px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 8px;
            padding: 10px 0;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: white;
            color: red;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown a {
            display: flex;
            align-items: center;
            font-size: 18px;
            color: black;
            text-decoration: none;
        }


/* Estilos para a seção de detalhes do produto */
.produto-detalhes {
    max-width: 1200px;
    margin: 40px auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.produto-detalhes h1 {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

.produto-info {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    margin-top: 20px;
}

.produto-imagem img {
    width: 100%;
    height: auto;
    max-width: 500px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}



.produto-descricao {
    max-width: 600px;
    flex: 1;
    margin-top: 100px;
}

.produto-descricao p {
    font-size: 22px;
    margin: 10px 0;
}

.produto-descricao strong {
    color: #555;
}

.adicionar-carrinho {
    margin-top: 20px;
    padding: 12px 20px;
    background-color: grey;
    color: white;
    border: none;
    font-size: 1.2rem;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.adicionar-carrinho:hover {
    background-color: #5d5d5d;
}

/* Responsividade */
@media (max-width: 768px) {
    .produto-info {
        flex-direction: column;
        align-items: center;
    }

    .produto-imagem img {
        max-width: 80%;
    }

    .produto-descricao {
        max-width: 90%;
        margin-top: 20px;
    }
}

    </style>
</head>
<body>

<!-- Header -->
<header>
    <div class="search-bar">
        <input type="text" placeholder="Pesquisar">
        <button type="button">
            <img src="lupa.png" alt="Pesquisar">
        </button>
    </div>

    <div class="viel">
        <a href="index.php">
            <h2>viɘl</h2>
        </a>
    </div>

    <div class="login dropdown">
        <a href="javascript:void(0)">
            <ion-icon id="icone" name="person-outline"></ion-icon>
        </a>
        <div class="dropdown-content">
            <a href="sair.php">Sair</a>
        </div>
    </div>

    <div class="cart">
        <a href="carrinho.php"><ion-icon name="cart-outline"></ion-icon></a>
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

<!-- Exibe os detalhes do produto -->
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
        echo "
        <div class='produto-detalhes'>
            <h1>" . htmlspecialchars($product['cor']) . " - " . htmlspecialchars($product['tamanho']) . "</h1>
            <div class='produto-info'>
                <div class='produto-imagem'>
                    <img src='" . htmlspecialchars($product['imagem']) . "' alt='Imagem do produto' class='zoom-imagem'>
                </div>
                <div class='produto-descricao'>
                    <p><strong>Descrição:</strong> " . nl2br(htmlspecialchars($product['descricao'])) . "</p>
                    <p><strong>Material:</strong> " . htmlspecialchars($product['material']) . "</p>
                    <p><strong>Quantidade:</strong> " . htmlspecialchars($product['quantidade']) . "</p>
                    <p><strong>Preço:</strong> R$ " . number_format($product['valor'], 2, ',', '.') . "</p>
                    
                    <!-- Formulário de adicionar ao carrinho -->
                    <form action='carrinho.php' method='POST'>
                        <input type='hidden' name='id_produto' value='" . $product['id'] . "'>
                        <input type='hidden' name='nome' value='" . htmlspecialchars($product['cor']) . " - " . htmlspecialchars($product['tamanho']) . "'>
                        <input type='hidden' name='preco' value='" . $product['valor'] . "'>
                        <input type='hidden' name='quantidade' value='1'>
                        <button type='submit' name='adicionar_ao_carrinho' class='adicionar-carrinho'>Adicionar ao Carrinho</button>
                    </form>
                </div>
            </div>
        </div>
        ";
    } else {
        echo "<p>Produto não encontrado.</p>";
    }

    // Fechar a conexão
    $conexao->close();
} else {
    echo "<p>ID de produto não fornecido.</p>";
}
?>


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
