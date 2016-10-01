<?php
  require 'PHPMailer/PHPMailerAutoload.php';
  $option = isset($_POST["option"]) ? $_POST["option"] : "";
  $mailto="care@subanutrients.com";
  if(strcasecmp("business", $option) == 0) {
    $mailto = "sales@subanutrients.com";
  } else if (strcasecmp("technical", $option) == 0) {
    $mailto = "technical@subanutrients.com";
  } else {
    $mailto = "care@subanutrients.com";
  }
  
  $file="thanks.html";
  $subject = isset($_POST['Subject']) ? "<Enquiry> ".$_POST['Subject'] : "<Enquiry>";
  
  $message_body_name = "<b>Sender's Name</b> : <p>".(isset($_POST['Name']) ? $_POST['Name'] : "<Name not provided>")."</p><br/>";
  $message_body_city = "<b>City</b> : <p>".(isset($_POST['City']) ? $_POST['City'] : "<City not provided>")."</p><br/>";
  $message_body_phone = "<b>Phone</b> : <p>".(isset($_POST['Contact_No']) ? $_POST['Contact_No'] : "<Phone not provided>")."</p><br/>";
  $email_link = isset($_POST['Email']) ? '<a href="mailto:'.$_POST['Email'].'">'.$_POST['Email'].'</a>' : "<Email not provided>";
  $message_body_email = "<b>Email</b> : <p>".$email_link."</p><br/>";
  $message_body_text = "<b>Message</b> : <p>".(isset($_POST['Message']) ? $_POST['Message'] : "")."</p><br/>";
  $message_body=$message_body_name.$message_body_city.$message_body_phone.$message_body_email.$message_body_text;
  //mail($mailto,$subject,$message_body,"From:".$from);

  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->CharSet = 'UTF-8';
                                              // Set mailer to use SMTP
  $mail->Host = 'smtp.zoho.com';  // Specify main and backup server
  $mail->SMTPDebug  = true;
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'no_reply@subanutrients.com';                            // SMTP username
  $mail->Password = 'raincheck1';                           // SMTP password
  $mail->SMTPSecure = 'ssl';   
  $mail->Port = 465;      
  $mail->From = "no_reply@subanutrients.com";
  $mail->FromName = "Mail Enquiry";
  $mail->AddAddress($mailto);
  $mail->AddAddress("aforarup@gmail.com");
  $mail->AddAddress("admin@subanutrients.com");
  $mail->WordWrap = 500;
  $mail->isHTML(true); 
  $mail->Subject = $subject;
  $mail->Body    = $message_body;

  $mail->send();
  include($file);

  
  
?>