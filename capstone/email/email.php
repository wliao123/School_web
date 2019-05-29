<?php
    //include PHPMaulerAutoload.php
    //require 'phpmailer/PHPMailerAutoload.php';
    //public function sendEmail(){
   // include(__DIR__."class.phpmailer.php");
    ///include(__DIR__."class.smtp.php");
    require 'class.phpmailer.php';
    require 'class.smtp.php';


    //create an instance of PHPMailer
    $mail = new PHPMailer();

    //set a host
    $mail->Host = "smtp.gmail.com";

    //enable SMTP
    $mail->IsSMTP();

    //set authentication to true
    $mail->SMTPAuth = true;

    //set login details for Gmail account 
    $mail->Username = "eddieforsure@gmail.com"; 
    $mail->Password = "qaz789456"; 

    //set type pf protection
    $mail->SMTPSecure = ssl;

    //set a port
    $mail->Port = 465;

    //set subject
    $mail->Subject = 'SMTP email test';

    //set body
    $mail->Body = 'this is some body';

    //set sender
    $mail->From = "eddieforsure@gmail.com"; 
    $mail->FromName = "SSU Computer Science Department";


    //set recipients
    $mail->addAddress('liaoweicheng123@gmail.com');

    // send an email
    if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            return false;
        } else {
            return true;
        }

  
?>
