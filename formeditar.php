<?php
$email = $_GET['email'];
require_once "conecta.php";
$conexao = conectar();

$sql = "SELECT * FROM usuario WHERE email='$email'";
$result = executarSQL($conexao, $sql);
$dados = mysqli_fetch_assoc($result);

if (!$dados) {
    echo "Usuário não encontrado.";
    die();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        input[type="text"]  {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="email"]  {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Usuário</h1>
        <form action="editar.php" method="post">
            <input type="hidden" name="id" value="<?= $dados['id_usuario']; ?>">
            <label for="nome">Nome:</label> <input type="text" id="nome" name="nome" value="<?= $dados['nome']; ?>" required>  
            <label for="email">Email:</label> <input type="email" id="email" name="email" value="<?= $dados['email']; ?>" required>
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>
