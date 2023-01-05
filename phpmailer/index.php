<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';
require '../model/employeePortalModel.php';
$employee = new employeePortal();
$receiver =  $employee->getEmployeeData($_POST['email']);

$email = $receiver['email'];

$randomCode = rand(1000,9999);
$token = bin2hex(random_bytes(32));

// $receiver['email'] = "gilad44757@edinel.com";
// $receiver['name'] = "jeffrid";

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'jeffrid.laxamana@cvsu.edu.ph';                     //SMTP username
    $mail->Password   = 'Jeff#101498';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('jeffrid.laxamana@cvsu.edu.ph', 'jeffrid');
    $mail->addAddress($receiver['email'], $receiver['name']);     //Add a recipient


    //Content
    $mail->isHTML(true);                             // Set email format to HTML
    $mail->CharSet = "UTF-8";                                //Set email format to HTML
    $mail->Subject = 'ForgotPassword';
    $mail->Body    = "

<html>
<head>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css'>
</head>
<style>
.button{
    margin-top: 4em;
    background-color:#004d28;
    color: #fff;
    border:none; 
    border-radius:10px; 
    padding:15px; 
}

h1{
    color:#004d28;
}

a:link { text-decoration: none; }


a:visited { text-decoration: none; }


a:hover { text-decoration: none; }


a:active { text-decoration: none; }
.card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 75%;
    height:300px;
    padding:10px;
}
</style>

<center>
<body>
<div class='card'>
<div class='card-body text-center'>
    <br><br><br>    
    <h1>Password Reset</h1>
    <p>if you've lost your password or wish to reset it,</p>
    <p>use the link below to get started</p>
    <br>
    <div>
    <a  class='button' href='http://localhost/employeeforgotpassword/changePassword.php?token=$token&email=$email'>Reset your Password</a>
    </div>
</div>
</div>
</body>
</html>
    
    
    
    
    
    
    
    ";


    if($mail->send())
    {

        $saveToken= $employee->saveToken($email,$token);
        if($saveToken == "1")echo "1";
        else echo "Saving token failed please resend the code!";
        
    }
    else {
        echo 'Message could not be sent.';
    }
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}