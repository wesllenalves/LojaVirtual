<?php

namespace App\Helps;

use PHPMailer\PHPMailer\PHPMailer;

class Funcoes {

    public function tratarCaracter($valor, $tipo) {
        switch ($tipo) {
            case 1: $rst = utf8_decode($valor);
                break;
            case 2: $rst = htmlentities($valor, ENT_QOUTES, "ISO-8859-1");
                break;
        }
        return $rst;
    }

    public function dataAtual($tipo) {
        date_default_timezone_set("America/Sao_Paulo");
        switch ($tipo) {
            case 1: $rts = date("Y-m-d");
                break;
            case 2: $rts = date("Y-m-d H:i:s");
                break;
            case 3: $rts = date("d-m-Y H:i:s");
                break;
        }
        return $rts;
    }

    public function formatadata($date, $tipo) {
        date_default_timezone_set("America/Sao_Paulo");
        switch ($tipo) {

            case 1: $rts = $date->format('Y-m-d');
                break;
        }
        return $rts;
    }

    public function base64($valor, $tipo) {
        switch ($tipo) {
            case 1: $rts = md5($valor);
                break;
            case 2: $rts = base64_encode($valor);
                break;
            case 3: $rts = base64_decode($valor);
                break;
        }
        return $rts;
    }

    public function EnviarEmail($dados) {
        //Create a new PHPMailer instance
        $mail = new PHPMailer;
//Tell PHPMailer to use SMTP
        $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
        $mail->SMTPDebug = 4;
//Set the hostname of the mail server
        // $mail->Host = 'smtp.gmail.com';
// use
        
        $mail->Host = 'smtp.mailtrap.io';
        
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 465;
//Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'plain';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "468118db151f47";
//Password to use for SMTP authentication
        $mail->Password = 'c1a05514b15db3';

        //Set who the message is to be sent from
        $mail->setFrom('wesllenalves@gmail.com', 'First Last');

//Set who the message is to be sent to
        $mail->addAddress($dados['email']);
        $mail->addReplyTo('wesllenalves@gmail.com', 'First Last');
        $mail->Subject = '' . $this->tratarCaracter($dados['assunto'], 1) . '';

        $html = '<p><strong>Nome:</strong>' . $this->tratarCaracter($dados['nome'], 1) . '<br>';
        $html .= '<p><strong>E-mail:</strong>' . $dados['email'] . '<br>';
        $html .= '<p><strong>Assunto:</strong>' . $this->tratarCaracter($dados['assunto'], 1) . '<br>';
        $html .= '<p><strong>Menssagem:</strong><br>';
        $html .= $this->tratarCaracter($dados['mensagem'], 1) . '</p>';

        $mail->msgHTML($html);
        if (!$mail->send()) {
            
            
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
            //Section 2: IMAP
            //Uncomment these to save your message in the 'Sent Mail' folder.
            #if (save_mail($mail)) {
            #    echo "Message saved!";
            #}
        }
    }

}
