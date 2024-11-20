<?php
// Inclui o arquivo de configuração
include_once('config.php');

// Verifica se o formulário foi enviado
if (isset($_POST['update'])) {
    // Sanitiza os dados do formulário para evitar injeção de SQL
    $id = mysqli_real_escape_string($conexao, $_POST['id']);
    $cor = mysqli_real_escape_string($conexao, $_POST['cor']);
    $tamanho = mysqli_real_escape_string($conexao, $_POST['tamanho']);
    $quantidade = mysqli_real_escape_string($conexao, $_POST['quantidade']);
    $valor = mysqli_real_escape_string($conexao, $_POST['valor']);
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $material = mysqli_real_escape_string($conexao, $_POST['material']);

    // Variável para o nome da imagem
    $imagem = "";

    // Verifica se o campo de imagem foi preenchido com um arquivo
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        // Define o diretório onde as imagens serão armazenadas
        $diretorio = "img/";

        // Verifica se o diretório existe, se não, cria
        if (!file_exists($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        // Verifica se o arquivo enviado é uma imagem
        $tipoImagem = $_FILES['imagem']['type'];
        if (!in_array($tipoImagem, ['image/jpeg', 'image/png', 'image/gif'])) {
            echo "Erro: O arquivo enviado não é uma imagem válida.";
            exit;
        }

        // Obtém o nome do arquivo da imagem
        $imagem = $diretorio . basename($_FILES['imagem']['name']);

        // Move o arquivo da imagem para o diretório
        if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem)) {
            echo "Erro ao fazer o upload da imagem.";
            exit;
        }
    } else {
        // Se não foi enviado um novo arquivo de imagem, mantém a imagem atual
        $sqlSelect = "SELECT imagem FROM camisetas WHERE id = ?";
        $stmtSelect = $conexao->prepare($sqlSelect);
        $stmtSelect->bind_param("i", $id);
        $stmtSelect->execute();
        $result = $stmtSelect->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $imagem = $row['imagem'];  // Mantém a imagem existente
        }
        $stmtSelect->close();
    }

    // Prepara a consulta SQL utilizando prepared statements
    $sqlUpdate = "UPDATE camisetas SET cor=?, tamanho=?, quantidade=?, valor=?, descricao=?, material=?, imagem=? WHERE id=?";
    $stmt = $conexao->prepare($sqlUpdate);

    // Verifica se o statement foi preparado corretamente
    if ($stmt === false) {
        die('Erro na preparação da query: ' . $conexao->error);
    }

    // Realiza o bind para os tipos de dados corretos
    $stmt->bind_param("ssidsisi", $cor, $tamanho, $quantidade, $valor, $descricao, $material, $imagem, $id);

    // Executa a consulta
    if ($stmt->execute()) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar dados: " . $stmt->error;
    }

    // Fecha o statement
    $stmt->close();
}

// Redireciona para a lista de camisetas após a atualização
header('Location: listaproduto.php');
exit;
?>
