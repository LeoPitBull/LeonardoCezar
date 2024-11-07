<?php
    session_start();
    if(isset($_POST['submit']) && !empty($_POST['cpf']) && !empty($_POST['email']) && !empty($_POST['senha']))

        if ($row['tipo'] == 1) {
            $_SESSION['email'] = $row['email'];
                header("Location: adm.php"); // Redireciona para administrador
            } else {
        include_once('config.php');
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM clientes WHERE cpf = '$cpf' and email = '$email' and senha = '$senha'";

        $result = $conexao->query($sql);

        if(mysqli_num_rows($result) < 1)
        {
            unset($_SESSION['cpf']);
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: login.php');
        }
        else
        {
            $_SESSION['cpf'] = $cpf;
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: index.php');
        }
    }
    else
    {
        header('Location: login.php');
    }
?>