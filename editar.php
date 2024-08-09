<?php
$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];

require_once "conecta.php";
$conexao = conectar();

$sql = "UPDATE usuario SET nome='$nome', email='$email' WHERE id_usuario='$id'";
$resultado = mysqli_query($conexao, $sql);

if ($resultado != false) {
    header('Location: index.php');
} else {
    echo "Não foi possível editar o perfil!";
    die();
}

?>