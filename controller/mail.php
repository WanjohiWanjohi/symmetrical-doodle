<?php
require_once "../connect.php";
require_once '/startbootstrap-sb-admin-2-gh-pages/PHPMailer/src/PHPMailer.php';
function sendMail($sender , $sendername ,$recipient ,$cc= null,$recipientname , $servicename , $servicecharge){
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'wamuyuwanjohi97@gmail.com';
    $mail->Password = 'Elzaphan11';
    $mail->SMTPSecure = 'ssl';
    $mail->setFrom ($sender,$sendername);
    $mail->addReplyto($sender, $sendername);
    $mail->addAddress($recipient,$recipientname);
    $mail->addCC($cc));
    $mail->isHTML(true);
    $bodyContent = '<h1>Reminder</h1>';
    $bodyContent .= "<p>This is a reminder that $servicename payment by credit card number is due soon.The amount due is $servicecharge <b>STL</b></p>";
    $mail->Subject = 'Email from Localhost Tut';
    $mail->Body    = $bodyContent;
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        return 1;
    } else {
        echo 'Message has been sent';
        return 0;
    }
    
}

/

?>