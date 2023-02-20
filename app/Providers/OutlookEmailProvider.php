<?php
namespace App\Providers;
use App\Interfaces\EmailProviderInterface;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class OutlookEmailProvider implements EmailProviderInterface {
    public function send(string $to, string $subject, string $message): bool {
        $mail = new PHPMailer();

        $mail->SetLanguage("es", "/language/");
        $mail->CharSet = 'UTF-8';
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->SMTPDebug = 0;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
        //Set the hostname of the mail server
        $mail->Host = $_ENV['MAIL_OUTLOOK_HOST'];
        $mail->Timeout = 60;
        $mail->Port = $_ENV['MAIL_OUTLOOK_PORT'] ;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = $_ENV['MAIL_OUTLOOK_SMTSECURE'];
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = $_ENV['MAIL_OUTLOOK_USERNAME'];
        //Password to use for SMTP authentication
        $mail->Password = $_ENV['MAIL_OUTLOOK_PASSWORD'];   
        //Set who the message is to be sent from
        $mail->Subject = $subject;
        $mail->setFrom($_ENV['MAIL_OUTLOOK_USERNAME'], $_ENV['MAIL_OUTLOOK_FROM_NAME']);
        $mail->addAddress($to);
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($message);
        $mail->AltBody = $_ENV['MAIL_OUTLOOK_FROM_NAME'];
        
        if (!$mail->send()) {
            print_r($mail->ErrorInfo);
            return false;
        } else {
            return true;
        }
    }
}