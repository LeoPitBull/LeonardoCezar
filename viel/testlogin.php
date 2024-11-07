<?php
session_start();

// Verifica se o formulário foi enviado e se os campos necessários não estão vazios
if (isset($_POST['submit']) && !empty($_POST['cpf']) && !empty($_POST['email']) && !empty($_POST['senha'])) {

    // Inclui a configuração da conexão
    include_once('config.php');
    
    // Recebe os dados do formulário
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Preparação da consulta SQL para evitar SQL Injection
    $sql = "SELECT * FROM clientes WHERE cpf = ? AND email = ? AND senha = ?";

    // Prepara a consulta
    if ($stmt = $conexao->prepare($sql)) {
        // Bind dos parâmetros
        $stmt->bind_param("sss", $cpf, $email, $senha); // "sss" indica que todos os parâmetros são strings
        
        // Executa a consulta
        $stmt->execute();
        
        // Verifica o número de resultados
        $result = $stmt->get_result();
        
        if ($result->num_rows < 1) {
            // Se não encontrar usuário, limpa as variáveis da sessão
            unset($_SESSION['cpf']);
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: login.php');
        } else {
            // Se encontrar o usuário, armazena os dados na sessão
            $_SESSION['cpf'] = $cpf;
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: index.php');
        }
        
        // Fecha a consulta
        $stmt->close();
    } else {
        // Caso a consulta não possa ser preparada
        echo "Erro na preparação da consulta: " . $conexao->error;
    }
} else {
    // Caso os campos obrigatórios não sejam preenchidos
    header('Location: login.php');
}
?>
