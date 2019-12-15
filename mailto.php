<?php
if(!isset($_POST['submit']))
{
    echo("error");
}

$name=$_POST['name'];
$visitoremail=$_POST['email'];
$surname=$_POST['surname'];
$message=$_POST['message'];

if(empty($name) || empty($surname) || empty($visitoremail) || empty($message))
{
    echo("error");
}

$to = "sulhdogan@gmail.com";
$subject = "Geri bildirim";
$headers =  "From: $visitoremail\r\n" .
            "Reply-To: $to \r\n" .
            "X-Mailer: PHP/" . phpversion();

mail($to, $subject, $message, $headers);
?>

