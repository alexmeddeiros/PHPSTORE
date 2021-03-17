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
        $mail->Username = '******@gmail.com';
        $mail->Password = '******';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        // Emissor e receptor
        $mail->setFrom('******@gmail.com', 'PHP STORE');
        $mail->addAddress($emailCostumer);

        // conteúdo
        $mail->isHTML(true);
        $mail->Subject = APP_NAME . ' - Confirmação de email.';
        $html = 'Seja bem vindo à nossa ' . APP_NAME . ' <bold>cliqui no link abaixo para confirmar seu email.';
        $html .= '<p><a href="' . $link . '">Confirmar email</a></p>';
        $mail->Body = $html;

        if (!$mail->send()) {
            return true;
        } else {
            return false;
        }
    }
}
