<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SMTPEmailConfig
 *
 * @author User
 */
class SMTPEmailConfig {

    function openSMTP($email, $subject, $content) {

        session_start();
        
        $status = 0;
        $mail = new PHPMailer();
        $mail->IsSMTP();

        $mail->Mailer = "smtp";
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port = $_SESSION['portnum'];
        $mail->Host = $_SESSION['host'];
        $mail->Username = $_SESSION['smtpusername'];
        $mail->Password =  $_SESSION['smtppasswrd'];       

        $toemail = $_SESSION['smtpusername'];
        $mail->IsHTML(true);
        $mail->SetFrom($toemail, "Brass Band Notification");
        $mail->AddReplyTo($toemail, "Brass Band Notification");
        $mail->AddCC($toemail, "Brass Band Notification");
        $mail->AddCC("pasindu@iclick.co.nz", "Testing ICLICK");

        $mail->AddAddress($email, "Pasindu");
        $mail->Subject = $subject;

        $mail->MsgHTML($content);
        if (!$mail->Send()) {
            echo "Error while sending Email.";
            var_dump($mail);
        } else {
            echo "Email sent successfully";
            $status = 1;
        }

        return $status;
    }

}
