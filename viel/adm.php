<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>viɘl - Administrador</title>
    <style>
        /* Resetando margens e padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Estilos gerais */
        body {
            font-family: Arial, sans-serif;
            background-color: #000; /* Fundo preto */
            color: #333;
            line-height: 1.6;
            padding: 20px;
            background-size: cover; /* A imagem vai cobrir toda a tela */
            background-position: center;
            width: 100%;
            height: 100vh;
            background-repeat: no-repeat; /* A imagem não vai se repetir */
        }

        header {
            background-color: rgba(209, 171, 0, 0.5); 
            color: white;
            padding: 15px;
            text-align: center;
        }

        header h1 {
            font-size: 2rem;
        }

        nav ul {
            list-style: none;
            margin-top: 10px;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
        }

        nav ul li a:hover {
            color: #18bc9c;
        }

        .contato {
            display: flex;
            flex-wrap: wrap; /* Permite que os botões quebrem para a próxima linha se necessário */
            justify-content: center; /* Centraliza os botões na tela */
            gap: 20px; /* Adiciona espaçamento entre os botões */
            margin-top: 30px;
        }

        .contato a {
            text-align: center; /* Garante que o texto dentro do botão está centralizado */
        }

        .contato button {
            background-color: #d1ab00;
            color: white;
            padding: 15px 35px; /* Aumentei o padding para botões maiores */
            font-size: 1.25rem; /* Aumentei o tamanho da fonte */
            border: none;
            border-radius: 8px; /* Bordas mais arredondadas */
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 250px; /* Largura fixa para todos os botões */
        }

        .contato button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<header>
    <h1>viɘl - Administrador</h1>
    <nav>
        <ul>
            <!-- Corrigi o link de "HOME" para o arquivo correto "index.php" -->
            <li><a href="index.php">HOME</a></li>
        </ul>
    </nav>
</header>

<section class="contato">
    <a href="listacliente.php"><button>Lista de clientes</button></a>
    <a href="camisetas.php"><button>Cadastrar produto</button></a>
    <a href="cards.php"><button>Visualizar os cards</button></a>
</section>

</body>
</html>