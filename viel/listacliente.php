<?php
// Inclui o arquivo de configuração (config.php)
include_once('config.php');

// Obtém o termo de busca da URL (se existir)
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Previne SQL Injection
$searchTerm = mysqli_real_escape_string($conexao, $searchTerm);

// Cria a consulta SQL com filtragem por nome ou email usando prepared statements
$sql = "SELECT nome, email, senha, telefone, endereco, cidade, estado, tipo, cpf 
        FROM clientes 
        WHERE cpf LIKE ? 
        OR email LIKE ?";

// Prepara a consulta
$stmt = $conexao->prepare($sql);

// Fazendo o "bind" das variáveis para os parâmetros
$searchTermParam = "%$searchTerm%";
$stmt->bind_param("ss", $searchTermParam, $searchTermParam);

// Executa a consulta
$stmt->execute();
$result = $stmt->get_result();

// Verifica se houve erro na consulta
if (!$result) {
    die("Falha ao executar a consulta: " . $conexao->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Lista de Clientes</title>
    <style>
        /* Definindo variáveis para cores */
        :root {
            --primary-color: #2c3e50; /* Cor de fundo escuro */
            --secondary-color: #ecf0f1; /* Cor de fundo clara */
            --accent-color: #3498db; /* Cor de destaque (azul) */
            --hover-color: #2980b9;  /* Cor de hover mais intensa */
            --white: #fff;
            --text-dark: #2d3436; /* Texto escuro */
            --border-radius: 8px; /* Borda arredondada */
        }

        /* Corpo da página */
        body {
            font-family: 'Arial', sans-serif;
            background-color: white;
            color: var(--text-dark);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Cabeçalho */
        h1 {
            color: black;
            font-size: 2.5rem;
            margin-top: 40px;
            font-weight: 600;
            text-align: center;
        }

        /* Tabela */
        .table {
            width: 100%;
            max-width: 1200px;
            background-color: var(--secondary-color);
            border-radius: var(--border-radius);
            margin-top: 30px;
            box-shadow: 3px 4px 10px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }

        /* Cabeçalho da tabela */
        .table th {
            background-color: #d3ad7f;
            color: var(--white);
            font-size: 1.1rem;
            padding: 12px;
            text-align: center;
        }

        /* Linhas da tabela */
        .table td {
            background-color: var(--secondary-color);
            color: var(--text-dark);
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        /* Efeito de hover nas linhas da tabela */
        .table tr:hover {
            background-color: var(--hover-color);
            color: var(--white);
        }

        /* Botões de ação (Editar e Deletar) */
        .btn {
            font-size: 0.9rem;
            padding: 6px 12px;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Botão de Editar (azul) */
        .btn-primary {
            background-color: var(--accent-color);
            color: var(--white);
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--hover-color);
        }

        /* Botão de Deletar (vermelho) */
        .btn-danger {
            background-color: #e74c3c;
            color: var(--white);
            border: none;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        /* Barra de Pesquisa */
        .box-search {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
            align-items: center;
        }

        .box-search input {
            padding: 8px 15px;
            border-radius: var(--border-radius);
            border: 1px solid #ccc;
            font-size: 1rem;
            width: 300px;
            transition: border-color 0.3s ease;
        }

        .box-search input:focus {
            border-color: var(--accent-color);
            outline: none;
        }

        .box-search button {
            padding: 8px 15px;
            background-color: var(--accent-color);
            border: none;
            color: var(--white);
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .box-search button:hover {
            background-color: var(--hover-color);
        }

        /* Barra de navegação */
        .navbar {
            background-color: #d3ad7f;
            padding: 15px 30px;
            width: 100%;
        }

        /* Botão de Sair */
        .navbar .btn-danger {
            background-color: black;
            color: var(--white);
            font-size: 1rem;
            font-weight: 500;
        }

        .navbar .btn-danger:hover {
            background-color: #515151;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .table {
                width: 100%;
            }

            h1 {
                font-size: 2rem;
            }

            .box-search input {
                width: 80%;
            }

            .box-search {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="d-flex">
        <a href="adm.php" class="btn btn-danger me-5">Voltar</a>
    </div>
</nav>

<br>

<?php
echo "<h1>Lista de Clientes</h1>";
?>

<br>

<div class="box-search">
    <form action="" method="GET">
        <input type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Pesquisar por cpf ou email">
        <button type="submit">Pesquisar</button>
    </form>
</div>

<div class="m-5">
    <table class="table text-white table-bg">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Senha</th>
                <th scope="col">Telefone</th>
                <th scope="col">Endereço</th>
                <th scope="col">Cidade</th>
                <th scope="col">Estado</th>
                <th scope="col">Tipo</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($user_data = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($user_data['nome']) . "</td>";
                echo "<td>" . htmlspecialchars($user_data['email']) . "</td>";
                echo "<td>" . htmlspecialchars($user_data['senha']) . "</td>";
                echo "<td>" . htmlspecialchars($user_data['telefone']) . "</td>";
                echo "<td>" . htmlspecialchars($user_data['endereco']) . "</td>";
                echo "<td>" . htmlspecialchars($user_data['cidade']) . "</td>";
                echo "<td>" . htmlspecialchars($user_data['estado']) . "</td>";
                echo "<td>" . htmlspecialchars($user_data['tipo']) . "</td>";
                echo "<td>
                        <a class='btn btn-sm btn-primary' href='edit.php?cpf=" . urlencode($user_data['cpf']) . "' title='Editar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg>
                        </a>
                        <a class='btn btn-sm btn-danger' href='delete.php?cpf=" . urlencode($user_data['cpf']) . "' title='Deletar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                            </svg>
                        </a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
