<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Recuperação de Senha</title>
</head>

<body>
    Digite o seu e-mail para que você possa criar uma nova senha.<br>
    Será enviado um e-mail com um link de recuperação que você usará para criar uma nova senha.<br><br>
    <form action="recuperar.php" method="post">
        <label> Email: <input type="email" name="email" id=""></label><br>
        <input type="submit" value="Enviar e-mail de recuperação">
    </form>
</body>

</html>