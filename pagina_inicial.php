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

$sql = "SELECT * FROM usuario WHERE email = '$email'";
$resultado = mysqli_query($conexao, $sql);

if ($resultado != false) {
    $usuario = mysqli_fetch_assoc($resultado);
} else {
    echo "Erro ao executar comando SQL.";
    die();
}

$imagemPadrao = 'up/default.jpg';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container {
            background-color: white;
            padding: 80px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 1500%;
            max-width: 400px;
        }
        a {
            text-decoration: none;
            color: #4CAF50;
            display: block;
            margin: 10px 0;
        }
        a:hover {
            text-decoration: underline;
        }
        table {
            margin: 20px 0;
            width: 100%;
        }
        td {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bem vindo(a), <?php echo $usuario['nome']; ?>!</h1>
        <p>Seu email é: <?php echo $usuario['email']; ?></p>
        <table>
            <tbody>
                <?php
                $arquivo = $usuario['foto'];
                $caminhoUploads = 'up/';
                $caminhoArquivo = $caminhoUploads . $arquivo;

                if (empty($arquivo) || !file_exists($caminhoArquivo)) {
                    $caminhoArquivo = $imagemPadrao;
                }

                echo "<tr>";
                echo "<td><img src='" . $caminhoArquivo . "' width='100px' height='100px'></td>";
                echo "<td><a href='alterar.php?Nome_arquivo=" . $usuario["foto"] . "'>Alterar foto de perfil</a></td>";
                ?>
            </tbody>
        </table>
        <a href="sair.php">Sair</a>
        <a href="excluir.php?id_usuario=<?php echo $usuario["id_usuario"]?>">Apagar conta</a>
        <a href="formeditar.php?email=<?php echo $usuario["email"]; ?>">Editar conta</a>
    </div>
</body>

</html>
