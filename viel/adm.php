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
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 99;
            border-bottom: var(--border);
            background-color: var(--white);
            padding: 1rem 0;
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
    <div class="menu">
        <a href="index.php">Voltar para home</a>
        <div class="login">

        </div>
        <div class="icons">
            <a href="carrinho.php"><img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/000000/shopping-cart--v1.png" alt="shopping-cart--v1" /></a>
        </div>
    </div>
</header>

<br><br><br>
<center><h1>Ações</h1>

</center>
<br><br>

<section class="contato">
    <a href="listacliente.php"><button>Lista de Clientes</button></a>
    <a href="camisetas.php"><button>Cadastrar Produto</button></a>
</section>

<footer>
    <p>&copy; 2024 Sua Empresa. Todos os direitos reservados.</p>
</footer>

</body>
</html>