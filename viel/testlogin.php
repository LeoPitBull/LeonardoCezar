<?php
session_start();
include_once('config.php'); // Inclui o arquivo de configuração do banco

// Verificar se o formulário foi enviado e se todos os campos estão preenchidos
if (isset($_POST['submit']) && !empty($_POST['cpf']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta segura usando prepared statements para evitar SQL Injection
    $stmt = $conexao->prepare("SELECT * FROM clientes WHERE cpf = ? AND email = ? AND senha = ?");
    $stmt->bind_param("sss", $cpf, $email, $senha); // "sss" indica três strings
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se encontrou algum registro
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verificar o tipo de usuário (0 ou 1)
        if ((int)$row['tipo'] === 1) { // Administrador
            $_SESSION['email'] = $row['email'];
            header("Location: adm.php"); // Redireciona para a página do administrador
            exit; // Adiciona o exit após o redirecionamento
        } elseif ((int)$row['tipo'] === 0) { // Usuário normal
            $_SESSION['cpf'] = $cpf;
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header("Location: index.php"); // Redireciona para a página inicial
            exit; // Adiciona o exit após o redirecionamento
        }
    } else {
        // Limpar sessões e redirecionar para login se os dados forem inválidos
        unset($_SESSION['cpf']);
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
        exit; // Adiciona o exit após o redirecionamento
    }
} else {
    // Redirecionar para o login caso os campos não estejam preenchidos
   // header('Location: login.php');
    //exit; // Adiciona o exit após o redirecionamento
}
?>
