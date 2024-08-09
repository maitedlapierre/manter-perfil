<?php
$message = '';

if (isset($_POST['submit'])) {
    if (!empty($_POST['nome']) && !empty($_POST['senha']) && !empty($_POST['email'])) {
        require_once("conecta.php");
        $conexao = conectar();

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Verifica se o email já está cadastrado
        $sqlCheck = "SELECT * FROM `usuario` WHERE `email`='$email'";
        $resultCheck = mysqli_query($conexao, $sqlCheck);

        if (mysqli_num_rows($resultCheck) > 0) {
            $message = "<h1>O email já foi cadastrado!</h1>";
        } else {
            $sql = "INSERT INTO `usuario`(`nome`, `email`, `senha`) VALUES ('$nome','$email','$senha')";
            $resultado = mysqli_query($conexao, $sql);

            if ($resultado) {
                $message = "<h1>Cadastro feito com sucesso!</h1>";
            } else {
                $message = "<h1>Erro ao cadastrar. Tente novamente!</h1>";
            }
        }
    } else {
        $message = "<h1>Preencha os campos para efetuar seu cadastro!</h1>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
        }

        h1 {
            color: #333;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin: auto;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php echo $message; ?>
        <h1>Cadastre-se!</h1>
        <form action="formulario-cadastro.php" method="POST">
            Nome:<input type="text" name="nome" id="nome"> <br>
            E-mail:<input type="email" name="email" id="email"><br>
            Crie uma senha: <input type="password" name="senha" id="senha" placeholder="Somente números"><br>
            <input type="submit" name="submit" id="submit" value="Cadastrar">
        </form>
        <a href="index.php" class="back-link">Voltar</a>
    </div>
</body>

</html>
