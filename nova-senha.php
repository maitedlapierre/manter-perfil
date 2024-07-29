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
    <title>Nova</title>
</head>

<body>
    <form action="salvar-nova-senha.php" method="post">
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="token" value="<?= $token ?>">
        Email: <?= $email ?><br>
        <label> Senha: <input type="password" name="senha"></label><br>
        <label> Repita a Senha: <input type="password" name="repetirSenha"></label><br>
        <input type="submit" value="Salvar nova senha">
    </form>
</body>

</html>