<?php
session_start();

// Inicialize o carrinho se ele ainda não existe
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}
$carrinho = &$_SESSION['carrinho'];

// Verifique se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = isset($_POST['productId']) ? $_POST['productId'] : null;
    $productName = isset($_POST['productName']) ? $_POST['productName'] : null;
    $price = isset($_POST['price']) ? $_POST['price'] : null;
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    // Verifique se todos os dados necessários foram fornecidos
    if ($productId && $productName && $price) {
        // Adicione o produto ao carrinho
        $item = [
            'productId' => $productId,
            'productName' => $productName,
            'price' => $price,
            'quantity' => $quantity,
        ];

        // Verifique se o produto já está no carrinho
        $produtoExistente = false;
        foreach ($carrinho as &$produto) {
            if ($produto['productId'] === $productId) {
                $produto['quantity'] += $quantity;
                $produtoExistente = true;
                break;
            }
        }
        if (!$produtoExistente) {
            $carrinho[] = $item;
        }

        echo "Produto adicionado ao carrinho!";
    } else {
        echo "Erro: Dados do produto estão incompletos.";
    }
} else {
    echo "";
}

// Exibe o conteúdo do carrinho
foreach ($carrinho as $produto) {
    echo "<p>Produto: " . $produto['productName'] . " | Preço: " . $produto['price'] . " | Quantidade: " . $produto['quantity'] . "</p>";
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <script src="app.js" async></script>
    <title>Carrinho </title>
</head>
<body>
    <header>
        <h1>CARRINHO</h1>
    </header>
    <section class="contenedor">
        <!-- Contenedor de elementos -->
     <div class="contenedor-items">
            <div class="item">
                <span class="titulo-item">RM</span>
                <img src="img/rm2.jpg" alt="" class="img-item">
                <span class="precio-item">R$15.000</span>
                <button class="boton-item">COMPRAR</button>
            </div>
            <div class="item">
                <span class="titulo-item">Jungkook</span>
                <img src="img/jungkook.jpg" alt="" class="img-item">
                <span class="precio-item">R$25.000</span>
                <button class="boton-item">COMPRAR</button>
            </div>
            <div class="item">
                <span class="titulo-item">Jimin</span>
                <img src="img/jimin.jpg" alt="" class="img-item">
                <span class="precio-item">R$35.000</span>
                <button class="boton-item">COMPRAR</button>
            </div>
            <div class="item">
                <span class="titulo-item">NOVO PRODUTO</span>
                <img src="img/rm2.jpg" alt="" class="img-item">
                <span class="precio-item">R$18.000</span>
                <button class="boton-item">COMPRAR</button>
            </div>
            <div class="item">
                <span class="titulo-item">NOVO PRODUTO</span>
                <img src="img/rm2.jpg" alt="" class="img-item">
                <span class="precio-item">R$32.000</span>
                <button class="boton-item">COMPRAR</button>
            </div>
            <div class="item">
                <span class="titulo-item">NOVO PRODUTO</span>
                <img src="img/rm2.jpg" alt="" class="img-item">
                <span class="precio-item">R$18.000</span>
                <button class="boton-item">COMPRAR</button>
            </div>
            <div class="item">
                <span class="titulo-item">NOVO PRODUTO</span>
                <img src="img/rm2.jpg" alt="" class="img-item">
                <span class="precio-item">R$54.000</span>
                <button class="boton-item">COMPRAR</button>
            </div>
            <div class="item">
                <span class="titulo-item">NOVO PRODUTO</span>
                <img src="img/rm2.jpg" alt="" class="img-item">
                <span class="precio-item">R$32.000</span>
                <button class="boton-item">COMPRAR</button>
            </div>
            
        </div>
       
    
        <!-- Carrinho de Compras -->
        <div class="carrito" id="carrito">
            <div class="header-carrito">
                <h2>SEU CARRINHO</h2>
            </div>

            <div class="carrito-items">
               <!-- Carrinho de compras visivel -->
            </div>
            <div class="carrito-total">
                <div class="fila">
                    <strong>Total das compras</strong>
                    <span class="carrito-precio-total">
                        R$120.000,00
                    </span>
                </div>
                <button class="btn-pagar">Pagar <i class="fa-solid fa-bag-shopping"></i> </button>
            </div>
        </div>
    </section>
</body>
</html>