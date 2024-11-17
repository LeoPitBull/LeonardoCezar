<?php

if (!empty($_GET['cpf'])) {
    include_once('config.php');

    $cpf = $_GET['cpf'];

    // Usando consultas preparadas para evitar injeção de SQL
    $sqlSelect = "SELECT * FROM clientes WHERE cpf = ?";
    $stmt = $conexao->prepare($sqlSelect);
    $stmt->bind_param("s", $cpf); // Bind do parâmetro

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $sqlDelete = "DELETE FROM clientes WHERE cpf = ?";
        $stmtDelete = $conexao->prepare($sqlDelete);
        $stmtDelete->bind_param("s", $cpf); // Bind do parâmetro

        if ($stmtDelete->execute()) {
            // Exclusão bem-sucedida
        } else {
            echo "Erro ao excluir: " . $stmtDelete->error;
        }

        $stmtDelete->close();
    }

    $stmt->close();
}

header('Location: listacliente.php');
exit; // Sempre bom usar exit após redirecionar
?>