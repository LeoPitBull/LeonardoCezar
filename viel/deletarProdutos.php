<?php

if (!empty($_GET['id'])) {  // Verifica se o id foi passado na URL
    include_once('config.php');  // Inclui a configuração do banco de dados

    $id = $_GET['id'];  // Recebe o id da camiseta da URL

    // Usando consultas preparadas para evitar injeção de SQL
    $sqlSelect = "SELECT * FROM camisetas WHERE id = ?";  // Consulta para selecionar a camiseta pelo id
    $stmt = $conexao->prepare($sqlSelect);  // Prepara a consulta
    $stmt->bind_param("i", $id);  // Bind do parâmetro (id, do tipo inteiro)

    $stmt->execute();  // Executa a consulta
    $result = $stmt->get_result();  // Obtém o resultado da consulta

    if ($result->num_rows > 0) {  // Se a camiseta for encontrada
        $sqlDelete = "DELETE FROM camisetas WHERE id = ?";  // Consulta para excluir a camiseta
        $stmtDelete = $conexao->prepare($sqlDelete);  // Prepara a consulta de exclusão
        $stmtDelete->bind_param("i", $id);  // Bind do parâmetro (id, do tipo inteiro)

        if ($stmtDelete->execute()) {  // Executa a exclusão
            // Exclusão bem-sucedida
            echo "Camiseta excluída com sucesso!";
        } else {
            echo "Erro ao excluir a camiseta: " . $stmtDelete->error;  // Exibe erro caso a exclusão falhe
        }

        $stmtDelete->close();  // Fecha a consulta de exclusão
    } else {
        echo "Camiseta não encontrada.";  // Caso o id não corresponda a nenhuma camiseta
    }

    $stmt->close();  // Fecha a consulta de seleção
}

// Redireciona após a execução
header('Location: listaproduto.php');
exit;  // Sempre bom usar exit após redirecionar
?>
