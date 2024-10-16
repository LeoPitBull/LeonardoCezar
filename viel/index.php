<?php
    session_start();
    if ((!isset($_SESSION['cpf']) == true) and (!isset($_SESSION['email']) and (!isset($_SESSION['senha']) == true)))
    {
        unset($_SESSION['cpf']);
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }

?>
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

    <div class="viel">
      <a href="index.php">
      <h2>viɘl</h2>
      </a>
    </div>

    <div class="login">
      <a href="login.php">
      <ion-icon id="icone" name="person-outline"></ion-icon>
      </a>
    </div>

    <div class="cart">
            <ion-icon name="cart-outline"></ion-icon>
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

 <!-- Carousel -->
<div class="carousel-container">
  <div class="carousel-track">
    <div class="carousel-item">
      <a href="#"> <!-- Adicione a URL da página de compra aqui -->
        <img src="img/lançamentojaqueta.jpeg" alt="Imagem 1">
      </a>
    </div>
  <button class="carousel-prev">&lt;</button>
  <button class="carousel-next">&gt;</button>
</div>

  <!-- Produtos em Lançamento -->
<section class="lancamentos">
  <h2 class="titulo-lancamento">Camiseta Slim</h2>
  <div class="produtos-container">
    <div class="produto">
      <a href="preto.php"> <!-- Adicione a URL da página de compra aqui -->
        <img src="img/camisetapreta1.jpeg" alt="Produto 1">
        <div class="info">
          <p class="nome">Camiseta Slim - Preto</p>
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
</body>
</html>
