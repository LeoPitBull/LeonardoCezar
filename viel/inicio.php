<?php
include_once('config.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>viɘl</title>
  <style>
  

        /* Estilo para o carrossel */
.carrossel {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.carrossel-items {
    display: flex;
    transition: transform 0.5s ease;
}

.produto {
    flex: 0 0 300px; /* Tamanho fixo para cada produto */
    margin: 10px;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.produto a {
    text-decoration: none;
    color: inherit;
}

.produto img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.card .info {
    padding: 10px 0;
}

.card .nome {
    font-weight: bold;
    margin: 10px 0;
}

.card .descricao, .card .material, .card .quantidade, .card .preco {
    font-size: 14px;
    margin: 5px 0;
}

button {
    padding: 10px;
    background-color: grey;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    transition: 0.3s;
}

button:hover {
    background-color: #5d5d5d;
}

/* Estilos para os controles do carrossel */
button.prev, button.next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
    border-radius: 50%;
    z-index: 100;
}

button.prev {
    left: 10px;
}

button.next {
    right: 10px;
}

/* Responsividade */
@media (max-width: 768px) {
    .produto {
        flex: 0 0 200px;
    }
}

@media (max-width: 480px) {
    .produto {
        flex: 0 0 100%;
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
      <a href="inicio.php">
        <h2>viɘl</h2>
      </a>
    </div>

    <div class="login">
      <a href="login.php">
        <ion-icon id="icone" name="person-outline"></ion-icon>
      </a>
    </div>

    <div class="cart">
    <a href="carrinho.php" id="iconeCarrinho"><ion-icon name="cart-outline"></ion-icon></a>
</div>
  </header>

  <!-- Navegação -->
  <nav>
    <ul class="navbar">
      <li><a href="inicio.php">Início</a></li>
      <li><a href="#">Categorias</a></li>
      <li><a href="tabelademedidas.html">Tabela de Medidas</a></li>
      <li><a href="contato.html">Contato</a></li>
    </ul>
  </nav>

  <!-- Carousel -->
  <div class="carousel-container">
    <div class="carousel-track">
      <div class="carousel-item">
        <a href="#"> <!-- Adicione a URL da página de compra aqui -->
          <img src="img/lançamentojaqueta.jpeg" alt="Imagem 1">
        </a>
      </div>
    </div>
    <button class="carousel-prev">&lt;</button>
    <button class="carousel-next">&gt;</button>
  </div>

  <!-- Produtos em Lançamento -->
  <section class="lancamentos">
    <h2 class="titulo-lancamento">Produtos Disponíveis</h2>
    <div class="produtos-container">
        <?php
        // Consultar dados da tabela camisetas
        $sql = "SELECT id, cor, tamanho, quantidade, valor, descricao, material, imagem FROM camisetas";
        $result = $conexao->query($sql);

        if ($result->num_rows > 0) {
            echo "<div style='display: flex; flex-wrap: wrap; gap: 20px;'>"; // Container flexível para os cards

            // Percorrer os resultados e exibir os produtos
            while ($row = $result->fetch_assoc()) {
                // Gerar a URL do link para o produto, passando o id como parâmetro
                $productUrl = "produto.php?id=" . $row['id'];

                echo "
                <div class='produto' style='border: 1px solid #ddd; border-radius: 8px; width: 300px; padding: 15px;'>
                    <a href='" . $productUrl . "' style='text-decoration: none; color: inherit;'>
                        <div class='card'>
                            <img src='" . htmlspecialchars($row["imagem"]) . "' alt='Imagem do produto' style='width: 100%; height: auto; border-radius: 8px;'>
                            <div class='info'>
                                <p class='nome' style='font-weight: bold; margin: 10px 0;'>" . htmlspecialchars($row['cor']) . " - " . htmlspecialchars($row['tamanho']) . "</p>
                                <p class='descricao'>" . nl2br(htmlspecialchars($row['descricao'])) . "</p>
                                <p class='material'><strong>Material:</strong> " . htmlspecialchars($row['material']) . "</p>
                                <p class='quantidade'><strong>Estoque:</strong> " . htmlspecialchars($row['quantidade']) . "</p>
                                <p class='preco'><strong>Preço:</strong> R$ " . number_format($row['valor'], 2, ',', '.') . "</p>
                            </div>
                        </div>
                    </a>

                    <!-- Formulário para adicionar produto ao carrinho -->
                    <form action='carrinho.php' method='POST'>
                        <input type='hidden' name='id_produto' value='" . $row['id'] . "'>
                        <input type='hidden' name='nome' value='" . htmlspecialchars($row['cor']) . " - " . htmlspecialchars($row['tamanho']) . "'>
                        <input type='hidden' name='preco' value='" . $row['valor'] . "'>
                        <input type='hidden' name='quantidade' value='1'> <!-- Quantidade fixa para 1 -->
                        <button type='submit' class='adicionar_ao_carrinho'>Adicionar ao Carrinho</button>
                    </form>
                </div>
                ";
            }

            echo "</div>"; // Fechar o container do carrossel
            echo "</div>"; // Fechar a div do carrossel
        } else {
            echo "<p>Nenhum produto encontrado.</p>";
        }

        // Fechar conexão
        $conexao->close();
        ?>
    </div>
  </section>

  <!-- JavaScript para o carrossel -->
  <script src="script.js"></script>

  <!-- Rodapé -->
  <footer class="rodape">
    <div class="container">
      <div class="info-contato">
        <h3>Entre em Contato</h3>
        <p>Email: suporteviel@gmail.com</p>
        <p>Telefone: (45) 99851-2463</p>
      </div>
      <div class="redes-sociais">
        <h3>Siga-nos</h3>
        <a href="https://www.instagram.com/vini.souz_/" target="_blank" rel="noopener noreferrer">
          <img src="instagram.png" alt="Instagram">
        </a>
        <a href="https://www.tiktok.com/@vinicius.souz_?_t=8mPkx9M9zp0&_r=1" target="_blank" rel="noopener noreferrer">
          <img src="tiktok.png" alt="TikTok">
        </a>
      </div>
    </div>
    <div class="creditos">
      <p>&copy; 2023 viɘl. Todos os direitos reservados.</p>
    </div>
  </footer>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <script>
    // Aguardar o DOM estar completamente carregado
    document.addEventListener("DOMContentLoaded", function() {
      // Captura todos os botões "Adicionar ao Carrinho"
      const botoesAdicionar = document.querySelectorAll('.adicionar_ao_carrinho');

      // Adiciona o evento de clique para cada botão
      botoesAdicionar.forEach(function(botao) {
        botao.addEventListener("click", function(event) {
          // Impede a ação padrão do botão
          event.preventDefault();

          // Exibe um alerta informando que a ação foi bloqueada
          alert("Desculpe, você precisa estar logado para adicionar este item ao carrinho.");
        });
      });
    });
  </script>

<script>
    // Captura o ícone do carrinho
    const iconeCarrinho = document.getElementById('iconeCarrinho');

    // Adiciona o evento de clique
    iconeCarrinho.addEventListener('click', function(event) {
        // Impede a ação padrão do link (navegação para a página carrinho.php)
        event.preventDefault();

        // Exibe um alerta informando que o carrinho não pode ser acessado
        alert("Desculpe, você precisa estar logado para acessar o carrinho.");
    });
</script>

<script>
    let currentIndex = 0;
    const items = document.querySelector('.carrossel-items');
    const totalItems = document.querySelectorAll('.produto').length;

    document.querySelector('.prev').addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = totalItems - 1;
        }
        updateCarrossel();
    });

    document.querySelector('.next').addEventListener('click', () => {
        if (currentIndex < totalItems - 1) {
            currentIndex++;
        } else {
            currentIndex = 0;
        }
        updateCarrossel();
    });

    function updateCarrossel() {
        const offset = -currentIndex * 320; // 320px é a largura do item + margem
        items.style.transform = `translateX(${offset}px)`;
    }
</script>

</body>
</html>
