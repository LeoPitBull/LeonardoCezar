<?php
//cpf	nome	email	telefone	sexo	data_nascimento	cidade	estado	endereco
if (isset($_POST['submit'])) {
    include_once 'config.php';
    // Recebe os dados do formulário
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $endereco = $_POST['endereco'];
    $senha = $_POST['senha'];

    // Verifica se o CPF já está cadastrado
    $query_verifica_cpf = "SELECT * FROM clientes WHERE cpf = '$cpf'";
    $result_verifica_cpf = mysqli_query($conexao, $query_verifica_cpf);
    
    if (mysqli_num_rows($result_verifica_cpf) > 0) {
        echo "Este CPF já está cadastrado. Por favor, utilize outro CPF.";
    } else{

    $query_insere_dados = "INSERT INTO clientes(cpf, nome, email, telefone, data_nascimento, cidade, estado, endereco, senha) 
                           VALUES ('$cpf','$nome', '$email', '$telefone', '$data_nascimento', '$cidade', '$estado', '$endereco', '$senha')";
    
    $result = mysqli_query($conexao, $query_insere_dados);

    if ($result) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar. Por favor, tente novamente.";
    }
}

}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário | viɘl</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: url(img/IMG_0208.JPG);
        }

        .viel h2 {
            color: white;
            text-align: center;
            font-size: 40px;
        }

        .viel a{
            text-decoration: none;
        }

        .viel h2:hover{
            color: darkgray;
        }

        .box{
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 20%;
        }
        fieldset{
            border: 3px solid gray;
        }
        legend{
            border: 1px solid rgb(39, 39, 39);
            padding: 10px;
            text-align: center;
            background-color: rgb(39, 39, 39);
            border-radius: 8px;
        }
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 12px;
            color: white;
        }
        #data_nascimento{
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }
        #submit{
            background-image: linear-gradient(to right,rgb(39, 39, 39), rgb(39, 39, 39));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover{
            background-image: linear-gradient(to right,rgb(39, 39, 39), rgb(128, 128, 128));
        }

        /* Remove setas do campo de número no Chrome, Safari, Edge e Opera */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Remove setas do campo de número no Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .register{
            color: white;
            margin: 15px 0 10px;
        }

        .register p a{
            text-decoration: underline;
            color: white;
            transition: 0.3s ease-in-out;
        }

        .register p a:hover{
            color: dimgrey;
        }
    </style>
</head>
<body>


    <header>
        <div class="viel">
            <a href="index.html">
            <h2>viɘl</h2>
            </a>
        </div>
    </header>

    <div class="box">
        <form action="formulario.php" method="post">
            <fieldset>
                <legend><b>Fórmulário de Clientes</b></legend>
                <br><br>
                <div class="inputBox">
                    <input type="number" name="cpf" id="cpf" class="inputUser" required>
                    <label for="cpf" class="labelInput">CPF:</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome completo:</label>
                </div>
                <br><br>
                
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelInput">Email:</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone:</label>
                </div>
                <br><br>
                <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                <input type="date" name="data_nascimento" id="data_nascimento" required>
                <br><br><br>
                <div class="inputBox">
                    <input type="text" name="cidade" 
                    id="cidade" class="inputUser" required>
                    <label for="cidade" class="labelInput">Cidade:</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="estado" id="estado" class="inputUser" required>
                    <label for="estado" class="labelInput">Estado:</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="endereco" id="endereco" class="inputUser" required>
                    <label for="endereco" class="labelInput">Endereço:</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                    <label for="senha" class="labelInput">Senha:</label>
                </div>
                <br><br>
                <input type="submit" name="submit" id="submit">
                <div class="register">
                    <p>Já possui uma conta? <a href="login.php">Faça o login aqui.</a></p>
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>