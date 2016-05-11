<?php
/**
 *  php mupp.php  --subject="asubjectformmupp" \
 --content="contentfrommupp" \
 --to="zhangshuang@ibantang.com zhsh411@126.com" \
 --cc="zhsh411@163.com" \
 --attach="/Users/zhangshuang/Downloads/attachment.test1.txt /Users/zhangshuang/Downloads/attachment.test2.txt"
 * User: zhangshuang
 * Date: 16/5/10
 * Time: 18:49
 */
$env = arguments($argv);
var_dump($env);
$subject = "";
$content = "";
$to = array();
$cc = array();
$attach = array();

$announce = "

mupp configure:\n
    --subject\t\t\tmust, the subject of your email.\n
    --content\t\t\tmust, the content of your email.\n
    --to\t\t\tmust, the address(es) which you want to send your email.\n
    --cc\t\t\toptional, the address(es) which you want to cc your email.\n
    --attach\t\t\toptional, the file(s) which you want to add to yor email attachment(s).\n
    --help\t\t\toptional, help to use mupp.\n

";

$error = "
Error. %s.\n
";

if (!empty($env['help'])) {
    echo $announce;
    exit(-1);
} else {
    $subject = !empty($env['subject']) ? $env['subject'] : '';
    $content = !empty($env['content']) ? $env['content'] : '';
    $to = !empty($env['to']) ? $to = explode(" ", $env['to']) : array();
    $to = array_filter($to);
    $cc = !empty($env['cc']) ? $cc = explode(" ", $env['cc']) : array();
    $cc = array_filter($cc);
    $attach = !empty($env['attach']) ? $attach = explode(" ", $env['attach']) : array();
    $attach = array_filter($attach);
}

if (empty($subject)) {
    echo sprintf($error, "empty subject");
    exit(-1);
}

if (empty($to)) {
    echo sprintf($error, "empty to");
    exit(-1);
}

if (empty($content)) {
    echo sprintf($error, "empty content");
    exit(-1);
}

require dirname(__FILE__) . "/MailApi.php";

MailApi::send($subject, $content, $to, $cc, $attach);

function arguments($argv)
{
    $_ARG = array();
    foreach ($argv as $arg) {
        if (ereg('--help', $arg, $reg)) {
            $_ARG["help"] = true;
        } elseif (ereg('--([^=]+)=(.*)', $arg, $reg)) {
            $_ARG[$reg[1]] = $reg[2];
        } elseif (ereg('-([a-zA-Z0-9])', $arg, $reg)) {
            $_ARG[$reg[1]] = 'true';
        }
    }
    return $_ARG;
}
