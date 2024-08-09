<?php
session_start();
if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    require_once('conecta.php');
    $conexao= conectar();
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) < 1) {

        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: index?erro=1');
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header('Location: pagina_inicial.php');
    }
} else {
    header('location: login.php');
}
