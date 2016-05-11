<?php
/**
 * Created by PhpStorm.
 * User: zhangshuang
 * Date: 16/3/15
 * Time: 17:50
 */
include "PHPMailer/PHPMailerAutoload.php";

class MailApi
{
    public static function send($subject, $body, $to, $cc = array(), $attach = array())
    {
        if (empty($to) || empty($subject) || empty($body)) {
            return false;
        }

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.exmail.qq.com";
        $mail->SMTPAuth = true;
        $mail->Username = "monitor@xxxxxx.com";
        $mail->Password = "xxxxxxx";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        $mail->From = "monitor@xxxxxxx.com";
        $mail->FromName = "monitor";
        foreach ($to as $_to) {
            $mail->addAddress($_to);
        }
        foreach ($cc as $_cc) {
            $mail->addCC($_cc);
        }
        foreach($attach as $_attach) {
            $mail->addAttachment($_attach);
        }
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        if (!$mail->send()) {
            echo "ERROR" . $mail->ErrorInfo . "\n";
            return false;
        } else {
            return true;
        }
    }

    public static function sendProcess($subject, $body)
    {
        $to[] = array("xxxxxx@xxxx.com");
        return self::send($subject, $body, $to);
    }
}

