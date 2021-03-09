<?php

namespace core\classes;

use PHPMailer;

class SendEmail
{
    public function sendEmailConfirm($emailCostumer, $purl)
    {

        // Purl com link de validação
        $link = BASE_URL . '?a=emailConfirm&purl=' . $purl;

        $mail = new PHPMailer;

        // Config do Server
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'email@gmail.com';
        $mail->Password = 'secret';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        // Emissor e receptor
        $mail->setFrom('email@gmail.com', 'PHP STORE');
        $mail->addAddress($emailCostumer);

        // conteúdo
        $mail->isHTML(true);
        $mail->Subject = APP_NAME . ' - Confirmação de email.';
        $html = 'Seja bem vindo à nossa ' . APP_NAME . ' <bold>cliqui no link abaixo para confirmar seu email.';
        $html .= $link;
        $mail->Body = $html;

        if (!$mail->send()) {
            echo 'Não foi possivel enviar o email de confirmação.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Email de confirmação enviado';
        }
    }
}
