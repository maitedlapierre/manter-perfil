<?php

function conectar() {
    require_once "config.php";
$conexao= mysqli_connect($config['host'], $config['user'], $config['pass'], $config['db']); 
    if($conexao === false) {
        echo "Erro ao conectar à base de dados. Nº do erro: " . mysqli_connect_errno() . "." . mysqli_connect_errno();
        die();
    }

    return $conexao; 
}

function executarSQL($conexao, $sql) {
$resultado= mysqli_query($conexao, $sql);
    if($resultado === false) {
        echo "Erro ao executar comando SQL." . mysqli_errno($conexao) . " : " . mysqli_error($conexao);
        die();
    }

    return $resultado;
}

?>