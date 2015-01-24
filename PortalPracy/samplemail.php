<?php
/*
  From http://www.html-form-guide.com
  This is the simplest emailer one can have in PHP.
  If this does not work, then the PHP email configuration is bad!
 */
$msg = "";
if (isset($_POST['submit'])) {
    /*     * ***Important!****
      replace name@your-web-site.com below
      with an email address that belongs to
      the website where the script is uploaded.
      For example, if you are uploading this script to
      www.my-web-site.com, then an email like
      form@my-web-site.com is good.
     */

//	$from_add = "portalpracy@costam.com"; 
//
//	$to_add = "magdagrzesinska@gmail.com"; //<-- put your yahoo/gmail email address here
//
//	$subject = "Test Subject";
//	$message = "Test Message";
//	
//	$headers = "From: $from_add \r\n";
//	$headers .= "Reply-To: $from_add \r\n";
//	$headers .= "Return-Path: $from_add\r\n";
//	$headers .= "X-Mailer: PHP \r\n";
//
	
//    $to = "magda_1812@o2.pl";
//    $subject = "The mail subject goes here";
//    $content = "And this is the mail content!";
//    $random_hash = md5(date('r', time())); 
//    $headers = "From: webmaster@example.com\r\nReply-To: webmaster@example.com"; 
//    $headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\""; 
//    $attachment = chunk_split(base64_encode(file_get_contents('images/image.jpg'))); 
//    ob_start();
//    if (mail($to, $subject, $content, $headers)) {
//
//    //if(mail($to_add,$subject,$message,$headers)) 
//        $msg = "Mail sent OK";
//    } else {
//        $msg = "Error sending email!";
//    }
    require_once("php/class.phpmailer.php");
    $email = new PHPMailer();
    $email->From      = 'you@example.com';
    $email->FromName  = 'Your Name';
    $email->Subject   = 'Email with two attachments';
    $email->Body      = 'to jest email z zalacznikiem';
    $email->AddAddress( 'magdagrzesinska@gmail.com' );

    $file_to_attach = 'images/image.jpg';

    $email->AddAttachment( $file_to_attach  );
    $file_to_attach2 = 'images/arrow.gif';
    $email->AddAttachment( $file_to_attach2 , 'image2.jpg' );
    if( $email->Send()) echo 'wysłano';
        else echo 'błąd wysyłania';

    
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
    <head>
        <title>Test form to email</title>
    </head>

    <body>
<?php echo $msg ?>
        <p>
        <form action='<?php echo htmlentities($_SERVER['PHP_SELF']); ?>' method='post'>
            <input type='submit' name='submit' value='Submit'>
        </form>
    </p>


</body>
</html>



