<?php
$email = $_POST['email'];
$token = $_POST['token'];
$senha = $_POST['senha'];
$repetirSenha = $_POST['repetirSenha'];

require_once "conecta.php";
$conexao = conectar();

$sql = "SELECT * FROM recuperar_senha WHERE email = '$email' AND token = '$token'";
$resultado = executarSQL($conexao, $sql);
$recuperar = mysqli_fetch_assoc($resultado);

if ($recuperar == null) {
    $message = "E-mail ou token incorretos. Tente fazer um novo pedido de recuperação de senha.";
} else {
    // Verificar a validade do pedido
    date_default_timezone_set('America/Sao_Paulo');
    $agora = new DateTime('now');
    $data_criacao = DateTime::createFromFormat('Y-m-d H:i:s', $recuperar['data_criacao']);
    $umDia = DateInterval::createFromDateString('1 day');
    $data_expiracao = date_add($data_criacao, $umDia);

    if ($agora > $data_expiracao) {
        $message = "Essa solicitação de recuperação de senha expirou! Faça um novo pedido.";
    } elseif ($recuperar['usado'] == 1) {
        $message = "Esse pedido de recuperação de senha já foi utilizado anteriormente! Para recuperar a senha, faça um novo pedido de recuperação de senha.";
    } elseif ($senha != $repetirSenha) {
        $message = "A senha que você digitou é diferente da senha que você inseriu! Por favor, tente novamente.";
    } else {
        $sql2 = "UPDATE usuario SET senha = '$senha' WHERE email='$email'";
        executarSQL($conexao, $sql2);
        $sql3 = "UPDATE recuperar_senha SET usado = 1 WHERE email = '$email' AND token='$token'";
        executarSQL($conexao, $sql3);

        $message = "Nova senha cadastrada com sucesso! <br> <a href='index.php'>Acessar o sistema</a>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha</title>
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

        p.message {
            color: #d9534f;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Redefinição de Senha</h1>
        <?php if (isset($message)) : ?>
            <p class="message"><?= $message ?></p>
        <?php endif; ?>
    </div>
</body>

</html>
