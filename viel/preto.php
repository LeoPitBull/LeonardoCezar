<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>viɘl</title>
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
  <div class="logo">
    <a href="index.html"> <!-- Substitua "pagina_inicial.html" pela URL desejada -->
      <H2>viɘl</H2>
    </a>
  </div>
  <div class="cart">
            <ion-icon name="cart-outline"></ion-icon>
  </div>
</header>

  <!-- Navegação -->
  <nav>
    <ul>
      <li><a href="index.php">Início</a></li>
      <li><a href="#">Categorias</a></li>
      <li><a href="tabelademedidas.html">Tabela de Medidas</a></li>
      <li><a href="contato.html">Contato</a></li>
    </ul>
  </nav>

  <!-- Detalhes do Produto -->
<section class="detalhes-produto">
  <div class="imagens-produto">
    <div class="imagens-pequenas">
      <img src="img/camisetapreta1.jpeg" alt="Produto 2">
      <img src="img/camisetapreta2.jpeg" alt="Produto 3">
    </div>
    <div class="imagem-grande">
      <img src="img/camisetapreta1.jpeg" alt="Produto 1">
    </div>
  </div>
  <div class="info-produto">
    <h2 class="nome-produto">Camiseta Slim - Preta</h2>
    <p class="preco">R$109,99</p>
    <!-- Adicione outras informações aqui -->
    <label for="quantidade">Quantidade:</label>
    <input type="number" id="quantidade" name="quantidade" value="1" min="1">
    <button class="botao-comprar">Comprar</button>
  </div>
</section>

<!-- Produtos em Lançamento -->
<section class="lancamentos">
  <h2 class="titulo-lancamento">Camiseta Slim</h2>
  <div class="produtos-container">
    <div class="produto">
      <a href="preto.html"> <!-- Adicione a URL da página de compra aqui -->
        <img src="img/camisetapreta1.jpeg" alt="Produto 1">
        <div class="info">
          <p class="nome">Camiseta Slim - Preta</p>
          <p class="preco">R$109,99</p>
          <!-- Adicione outras informações aqui -->
        </div>
      </a>
    </div>
    <div class="produto">
      <a href="cinza.html"> <!-- Adicione a URL da página de compra aqui -->
        <img src="img/camisetacinza1.jpeg" alt="Produto 2">
        <div class="info">
          <p class="nome">Camiseta Slim - Cinza</p>
          <p class="preco">R$109,99</p>
          <!-- Adicione outras informações aqui -->
        </div>
      </a>
    </div>
    <div class="produto">
      <a href="offwhite.html"> <!-- Adicione a URL da página de compra aqui -->
        <img src="img/camisabranca1.jpeg" alt="Produto 3">
        <div class="info">
          <p class="nome">Camiseta Slim - Off</p>
          <p class="preco">R$109,99</p>
          <!-- Adicione outras informações aqui -->
        </div>
      </a>
    </div>
      </a>
    </div>
  </div>
</section>

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

</body>
</html>
