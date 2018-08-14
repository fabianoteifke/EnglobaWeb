<?php
include_once dirname(__FILE__) . "/../config/conexao.php";

$mail = $_POST['email'];
$pdo->query("INSERT INTO user_temporario SET email='$mail'");

$id = $pdo->lastInsertId();
$md5 = md5($id);

//$header = "From: EnglobaWeb";
//$assunto = "Confirme seu cadastro:";
$link = "http://localhost/engloba/view/cad_institu.php?h=".$md5;
//$mensagem = "Clique no link abaixo para confirmar o cadastro:".$link;
//mail($mail, $assunto, $mensagem, $header);
 
// Inclui o arquivo class.phpmailer.php localizado na pasta class
require_once("../model/class.phpmailer.php");
 
// Inicia a classe PHPMailer
$mail = new PHPMailer(true);
 
// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(); // Define que a mensagem será SMTP
 
try {
     $mail->Host = 'smtp.gmail.com.br'; // Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
     $mail->SMTPAuth   = true;  // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
     $mail->Port       = 587; //  Usar 587 porta SMTP
     $mail->Username = 'teifkefabiano@gmail.com'; // Usuário do servidor SMTP (endereço de email)
     $mail->Password = 't22022000'; // Senha do servidor SMTP (senha do email usado)
 
     //Define o remetente
     // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=    
     $mail->SetFrom('teifkefabiano@gmail.com', 'Fabiano'); //Seu e-mail
     $mail->AddReplyTo('teifkefabiano@gmail.com', 'Fabiano'); //Seu e-mail
     $mail->Subject = 'Confirme seu cadastro';//Assunto do e-mail
 
 
     //Define os destinatário(s)
     //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     $mail->AddAddress('teifkefabiano@gmail.com', 'Teste Locaweb');
 
     //Campos abaixo são opcionais 
     //=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
     //$mail->AddCC('destinarario@dominio.com.br', 'Destinatario'); // Copia
     //$mail->AddBCC('destinatario_oculto@dominio.com.br', 'Destinatario2`'); // Cópia Oculta
     //$mail->AddAttachment('images/phpmailer.gif');      // Adicionar um anexo
 
 
     //Define o corpo do email
     $mail->MsgHTML('clique no link para confirmar seu cadastro: '.$link.''); 
 
     ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
     //$mail->MsgHTML(file_get_contents('arquivo.html'));
 
     $mail->Send();
     echo "Mensagem enviada com sucesso</p>\n";
 
    //caso apresente algum erro é apresentado abaixo com essa exceção.
    }catch (phpmailerException $e) {
      echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
}