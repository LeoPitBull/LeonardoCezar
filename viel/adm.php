<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">

    <style>
        :root {
            --main-color: #d3ad7f;
            --black: #13131a;
            --bg: #010103;
            --white: #fff;
            --border: 0.1rem solid rgba(255,255,255,0.3);
            font-size: 10px;
        }

        * {
            margin: 0;
            padding: 0;
            outline: none;
            border: none;
            text-decoration: none;
            text-transform: capitalize;
            transition: 0.2s linear;
            font-family: "ronoto", sans-serif;
        }

        body {
            background-color: var(--white);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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

        .menu {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
        }

        .menu a {
            color: var(--black);
            text-decoration: none;
            font-size: 1.5rem;
        }

        .menu a:hover {
            color: var(--main-color);
        }

        .icons img {
            margin: 1rem;
            cursor: pointer;
        }

        .icons img:hover {
            width: 40px;
            height: 40px;
        }

        .login h3 {
            font-size: 1.8rem;
            color: var(--black);
        }

        .btn {
            background: var(--main-color);
            color: var(--white);
            padding: 1rem 3rem;
            font-size: 1.7rem;
            cursor: pointer;
            margin-top: 1rem;
            display: inline-block;
            border-radius: 6px;
        }

        .btn:hover {
            letter-spacing: 0.1rem;
            background-color: #d3ad7f;
        }

        section {
            padding: 3rem 2rem;
            margin: 0 auto;
            max-width: 1200px;
            text-align: center;
            flex: 1; /* This makes the section fill the remaining space */
        }

        h1 {
            font-size: 3rem;
            color: var(--black);
            margin-bottom: 2rem;
        }

        .contato a {
            margin: 1rem;
        }

        .contato button {
            background: var(--main-color);
            color: var(--white);
            padding: 1rem 3rem;
            font-size: 1.6rem;
            border: none;
            cursor: pointer;
            border-radius: 6px;
            transition: 0.3s;
        }

        .contato button:hover {
            background-color: var(--black);
        }

        footer {
            text-align: center;
            padding: 2rem 0;
            background-color: var(--bg);
            color: var(--white);
            margin-top: auto; /* This ensures the footer stays at the bottom */
        }
        li{
            list-style: none;
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
      
      <div class="menu">
        <a href="sair.php">Desconectar-se</a>
    </div>
</header>

<br><br><br>
<center><h1>Ações</h1>

</center>
<br><br>

<section class="contato">
    <a href="listacliente.php"><button>Lista de Clientes</button></a>
    <a href="camisetas.php"><button>Cadastrar Produto</button></a>
    <a href="listaprodutos.php"><button>Lista de Produtos</button></a>
</section>

<footer>
    <p>&copy; 2024 viɘl. Todos os direitos reservados.</p>
</footer>

</body>
</html>