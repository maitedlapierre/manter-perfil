<?php

// verificar o e-mail
// verificar o token 
$email = $_GET['email'];
$token = $_GET['token'];

require_once "conecta.php";
$conexao = conectar();
$sql = "SELECT * FROM recuperar_senha WHERE email = '$email' AND token = '$token'";
$resultado = executarSQL($conexao, $sql);
$recuperar = mysqli_fetch_assoc($resultado);

if ($recuperar == null) {
    echo "E-mail ou token incorretos. Tente fazer um novo pedido de recuperação de senha.";
    die();
} else {
    //verifivar a validade do pedido
    //verificar se o link ja foi usado
    date_default_timezone_set('America/Sao_Paulo');
    $agora = new DateTime('now');
    $data_criacao = DateTime::createFromFormat('Y-m-d H:i:s', $recuperar['data_criacao']);
    $umDia = DateInterval::createFromDateString('1 day');
    $data_expiracao = date_add($data_criacao, $umDia);
    if ($agora > $data_expiracao) {
        echo "Essa solicitação de recuperação de senha expirou!
        Faça um novo pedido";
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
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
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

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
    </style>
</head>

<body>
    <div class="container">
        <h1>Redefinir Senha</h1>
        <form action="salvar-nova-senha.php" method="post">
            <input type="hidden" name="email" value="<?= $email ?>">
            <input type="hidden" name="token" value="<?= $token ?>">
            <p>Email: <?= $email ?></p>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>
            <label for="repetirSenha">Repita a Senha:</label>
            <input type="password" name="repetirSenha" id="repetirSenha" required>
            <input type="submit" value="Salvar nova senha">
        </form>
    </div>
</body>

</html>
