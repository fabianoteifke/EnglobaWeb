<?php
include_once dirname(__FILE__) . "/../config/conexao.php";

$mail = $_POST['email'];
$pdo->query("INSERT INTO user_temporario SET email='$mail'");

$id = $pdo->lastInsertId();
$md5 = md5($id);

$header = "Email de confirmação de cadastro EnglobaWeb";
$assunto = "Confirme seu cadastro:";
$link = "http://localhost/engloba/view/cad_institu.php?h=".$md5;
$mensagem = "Clique no link abaixo para confirmar o cadastro:".$link;

mail($mail, $assunto, $mensagem, $header);