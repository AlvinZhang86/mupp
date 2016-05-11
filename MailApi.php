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
        $mail->Username = "monitor@ibantang.com";
        $mail->Password = "Tfc,Gdcs[^6";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        $mail->From = "monitor@ibantang.com";
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
//        var_dump($mail);
        if (!$mail->send()) {
            echo "ERROR" . $mail->ErrorInfo . "\n";
            return false;
        } else {
            return true;
        }
    }

    public static function sendProcess($subject, $body)
    {
        $to[] = array("zhangshuang@ibantang.com");
        return self::send($subject, $body, $to);
    }
}

//$subject = "a subject";
//$body = "<h1>title</h1><br/><h4>h4</h4>";
//$to = array("zhangshuang@ibantang.com", "zhsh411@126.com");
//$result = MailApi::send($subject, $body, $to);
//var_dump($result);