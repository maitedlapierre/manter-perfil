<?php
session_start();
if ((!isset($_SESSION['nome']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    header('Location: index.php');
}
$logado = $_SESSION['nome'];

echo "<h1> Bem vindo(a) " .$_SESSION['nome']. "! </h1>";

?>