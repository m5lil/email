<?php

require_once "PHPMailer/class.phpmailer.php";
require_once "PHPMailer/class.smtp.php";

/* Check all form inputs using check_input function */
$name = check_input($_POST['name']);
$message  = check_input($_POST['message']);
$email    = check_input($_POST['email']);
$mobile  = check_input($_POST['mobile']);

/* Functions we used */
function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'Email';                 // SMTP username
$mail->Password = 'Pass';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom($email, $name);
$mail->addAddress('sales@doamin.com', $name);     // Add a recipient
// $mail->addAddress('ellen@example.com');               // Name is optional
// $mail->addReplyTo('info@example.com', 'Information');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Message From ' . $name;
$mail->Body    = '<b>Message: </b> ' . $message . '<hr><b>Mobile: </b> ' . $mobile . '<hr><b>Email: </b> ' . $email;
$mail->AltBody = 'Nothing else';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent <br> return after 3 second';
    echo '<script>
    setTimeout(function(){
      window.history.go(-1);
    }, 3000);
    </script>';

}
