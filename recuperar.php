<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "conecta.php";
$conexao = conectar();

$email = $_POST['email'];
$sql = "SELECT * FROM usuario WHERE email='$email'";
$resultado = executarSQL($conexao, $sql);

$usuario = mysqli_fetch_assoc($resultado);
if ($usuario === null) {
    echo '<div class= "alert alert danger" role="alert"> 
    <h2>Email não cadastrado!</h2><br>
    Faça o cadastro e em seguida realize o login. </div>'
    ;
    die();
}
//gerar um token unico 
$token = bin2hex(random_bytes(50));

require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';
include 'config.php';

$mail = new PHPMailer(true);
try {
    $mail -> CharSet = 'UTF-8';
    $mail -> Encoding = 'base64';
    $mail -> setLanguage('br');
    //$mail -> SMTPDebug = SMTP::DEBUG_OFF;
    $mail -> SMTPDebug = SMTP::DEBUG_SERVER;//imprime as mensagens de erro
    $mail -> isSMTP(); //envia o e-mail usando SMTP
    $mail -> Host = 'smtp.gmail.com';
    $mail -> SMTPAuth = true;
    $mail -> Username = $config['email'];
    $mail -> Password = $config['senha_email'];
    $mail -> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail -> Port = 587;
    $mail -> SMTPOptions = array (
        'ssl'=> array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
        )
     );
    //recipients
    $mail -> setFrom($config['email'], 'Aula de tópicos');
    $mail -> addAddress($usuario['email'], $usuario['nome']);
    $mail -> addReplyTo($config['email'], 'Aula de tópicos');

    //content
    $mail -> isHTML(true);
    $mail -> Subject = 'Recuperação de Senha do Sistema';
    $mail -> Body = 'Olá <br> 
            Você solicitou a recuperação da sua conta no nosso sistema.
            Para isso, clique no link abaixo para realizar a troca de senha:<br>
            <a href = "'. $_SERVER['SERVER_NAME'].'/manter-perfil/nova-senha.php?email='.$usuario['email'] . 
            '&token='.$token . '">Clique aqui para recuperar o acesso a sua conta!</a><br><br>
            Atenciosamente <br>
            Equipe do sistema...';

            //gravar informações na tabela recuperar-senha
            $data = new DateTime('now');
            $agora = $data->format('Y-m-d H:i:s');
            $sql2= "INSERT INTO recuperar_senha(email, data_criacao, token, usado) VALUES ('".$usuario['email'] ."','$agora', '$token', 0)";



            $mail ->send();
            echo '<div class= "alert alert-success" role="alert">
            <h2> Email enviado com sucesso!</h2><br> Confira seu e-mail.
            </div>';
            date_default_timezone_set('America/Sao_Paulo');
            $data = new DateTime('now');
            $agora = $data ->format('Y-m-d H:i:s');
            $sql2= "INSERT INTO recuperar_senha (email, data_criacao, token, usado) VALUES ('".$usuario['email']."', '$agora', '$token', 0)";
            executarSQL($conexao, $sql2);
} catch (Exception $e) {
    echo '<div class= "alert alert-danger" role="alert">
    <h2> Não foi possível enviar o e-mail.</h2><br>
     Mailer Error: {$mail->ErrorInfo}
     </div>';
}
