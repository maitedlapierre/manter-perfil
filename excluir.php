<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: index.php');
    exit();
}
$email = $_SESSION['email'];
$conexao = mysqli_connect("localhost", "root", "", "manter-perfil");

if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
        $sql = "DELETE FROM usuario WHERE email = '$email'";
        if (mysqli_query($conexao, $sql)) {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            session_destroy();
            header('Location:index.php');
        } else {
            echo "Erro ao apagar a conta: " . mysqli_error($conexao);
        }
    } else {
        echo "A exclusão da conta foi cancelada.";
        echo "<a href='pagina_inicial.php'>Voltar ao perfil</a>";
    }
    mysqli_close($conexao);
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apagar Conta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            margin: 20px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
        }

        .button-group button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .confirm-button {
            background-color: #e74c3c;
            color: white;
        }

        .cancel-button {
            background-color: #2ecc71;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Apagar Conta</h1>
        <p>Tem certeza que deseja apagar sua conta? Esta ação não pode ser desfeita.</p>
        <form method="POST" action="">
            <div class="button-group">
                <button type="submit" name="confirm" value="yes" class="confirm-button">Sim, apagar</button>
                <button type="submit" name="confirm" value="no" class="cancel-button">Não, cancelar</button>
            </div>
        </form>
        <a href="pagina_inicial.php">Voltar ao perfil</a>
    </div>
</body>

</html>
