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

    function openSMTP($email,$subject,$content) {
        $status = 0;
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";

        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = "STARTTLS";
        $mail->Port = 587;
        $mail->Host = "smtp.office365.com";
        $mail->Username = "notification@Identimark.com";
        $mail->Password = "System2020";
        $mail->IsHTML(true);
        $mail->SetFrom("notification@Identimark.com", "Identimark Notification");
        $mail->AddReplyTo("notification@identimark.com", "Identimark Notification");
        $mail->AddCC("notification@identimark.com", "Identimark Notification");
        $mail->AddCC("pasindu@iclick.co.nz", "Testing ICLICK");

        $mail->AddAddress($email, "Member");
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
