<?php
session_start();
if (isset($_POST['submit']) && !empty($_POST['nome']) && !empty($_POST['senha'])) {
    include('conecta.php');
    $conexao= conectar();
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE nome = '$nome' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) < 1) {

        unset($_SESSION['nome']);
        unset($_SESSION['senha']);
        header('Location: index?erro=1');
    } else {
        $_SESSION['nome'] = $nome;
        $_SESSION['senha'] = $senha;
        header('Location: inicio.php');
    }
} else {
    header('location: login.php');
}

?>