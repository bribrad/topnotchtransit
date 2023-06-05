<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
// echo phpinfo();
// echo exec('whoami');
//smtp settings 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

// email settings
$toEmail = 'ravenbradshaw@live.com';
$from = 'info@bribrad.com';
$fromName = 'BRIBRAD';

// File upload settings 
$attachmentUploadDir = "uploads/"; 
$allowFileTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 

debug_to_console($_POST);

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

/* Form submission handler code */ 
$postData = $uploadedFile = $statusMsg = $valErr = ''; 
$msgClass = 'errordiv'; 
if(isset($_POST['submit'])){ 
    // Get the submitted form data 
    $postData = $_POST; 
    $firstName = trim($_POST['inputFirstName']); 
    $lastName = trim($_POST['inputLastName']); 
    $email = trim($_POST['inputEmail']); 
    
    debug_to_console($firstName);
    debug_to_console($lastName);
    debug_to_console($email);

    // Validate input data 
    if(empty($firstName)){ 
        $valErr .= 'Please enter your name.<br/>'; 
    } 
    if(empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false){ 
        $valErr .= 'Please enter a valid email.<br/>'; 
    } 
    if(empty($lastName)){ 
        $valErr .= 'Please enter subject.<br/>'; 
    } 
         
    // Check whether submitted data is valid 
    if(empty($valErr)){ 
        $uploadStatus = 1; 
         
        // Upload attachment file 
        if(!empty($_FILES["attachment"]["name"])){ 
             
            debug_to_console('handling file upload');
            // File path config 
            $targetDir = $attachmentUploadDir; 
            $fileName = basename($_FILES["attachment"]["name"]); 
            $targetFilePath = $targetDir . $fileName; 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            
            debug_to_console('filename: '.$fileName);
            debug_to_console('targetFilePath: '.$targetFilePath);
            debug_to_console('fileyType' .$fileType);
            debug_to_console('from: ' .$_FILES["attachment"]["tmp_name"]);
            // Allow certain file formats 
            if(in_array($fileType, $allowFileTypes)){ 
                // Upload file to the server 
                debug_to_console($_FILES["attachment"]);
                if(move_uploaded_file($_FILES["attachment"]["tmp_name"], $targetFilePath)){ 
                    $uploadedFile = $targetFilePath; 
                    debug_to_console('success');
                }else{ 
                    $uploadStatus = 0; 
                    $statusMsg = "Sorry, there was an error uploading your file."; 
                    debug_to_console('failure');
                } 
            }else{ 
                $uploadStatus = 0; 
                $statusMsg = 'Sorry, only '.implode('/', $allowFileTypes).' files are allowed to upload.'; 
            } 
        } 
         
        if($uploadStatus == 1){ 
            // Email subject 
            $emailSubject = 'Employment Request Submitted by '.$firstName; 
             
            // Email message  
            $htmlContent = '<h2>Employment Request Submitted</h2> 
                <p><b>First Name:</b> '.$firstName.'</p> 
                <p><b>Last Name:</b> '.$lastName.'</p> 
                <p><b>Email Address:</b> '.$email.'</p>';
             
            $altContent = 'Name: '.$firstName . ' ' .$lastName . '\nEmail Address: '.$email;

            // Header for sender info 
            $headers = "From: $fromName"." <".$from.">"; 
 
            // Add attachment to email 
            if(!empty($uploadedFile) && file_exists($uploadedFile)){ 
                 
                // Boundary  
                $semi_rand = md5(time());  
                $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
                 
                // Headers for attachment  
                $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";  
                 
                // Multipart boundary  
                $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
                 
                // Preparing attachment 
                if(is_file($uploadedFile)){ 
                    $message .= "--{$mime_boundary}\n"; 
                    $fp =    @fopen($uploadedFile,"rb"); 
                    $data =  @fread($fp,filesize($uploadedFile)); 
                    @fclose($fp); 
                    $data = chunk_split(base64_encode($data)); 
                    $message .= "Content-Type: application/octet-stream; name=\"".basename($uploadedFile)."\"\n" .  
                    "Content-Description: ".basename($uploadedFile)."\n" . 
                    "Content-Disposition: attachment;\n" . " filename=\"".basename($uploadedFile)."\"; size=".filesize($uploadedFile).";\n" .  
                    "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
                } 
                 
                $message .= "--{$mime_boundary}--"; 
                $returnpath = "-f" . $email; 
                 
                try {
                    //Server settings
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.elasticemail.com';                //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'info@bribrad.com';                     //SMTP username
                    $mail->Password   = '9260C4167FC919A3769E0E8DE13B005DF563'; //SMTP password
                    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable implicit TLS encryption
                    $mail->Port       = 2525;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                
                    //Recipients
                    $mail->setFrom('info@bribrad.com', 'Bri Brad');
                    $mail->addAddress('brianabradshaw2015@gmail.com', 'Briana Bradshaw');     //Add a recipient
                    // $mail->addAddress('ellen@example.com');               //Name is optional
                    // $mail->addReplyTo('info@example.com', 'Information');
                    // $mail->addCC('cc@example.com');
                    // $mail->addBCC('bcc@example.com');
                
                    //Attachments
                    $mail->addAttachment($targetFilePath);         //Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = $emailSubject;
                    $mail->Body    = $htmlContent;
                    $mail->AltBody = $altContent;
                
                    $mail->send();
                    $msgClass = 'succdiv'; 
                    debug_to_console('Message has been sent');
                    $statusMsg = "Thank you for applying!";
                    $postData = '';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    $statusMsg = 'Failed! Something went wrong, please try again.'; 
                    debug_to_console('Message has NOT been sent');
                }
                 
                // Delete attachment file from the server 
                @unlink($uploadedFile); 
            }else{                  
                try {
                    //Server settings
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.elasticemail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'info@bribrad.com';                     //SMTP username
                    $mail->Password   = '9260C4167FC919A3769E0E8DE13B005DF563'; //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                
                    //Recipients
                    $mail->setFrom('info@bribrad.com', 'Bri Brad');
                    $mail->addAddress('brianabradshaw2015@gmail.com', 'Briana Bradshaw');     //Add a recipient
                
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = $emailSubject;
                    $mail->Body    = $htmlContent;
                    $mail->AltBody = $altContent;
                
                    $mail->send();
                    $msgClass = 'succdiv'; 
                    $statusMsg = "Thank you for applying!";
                    debug_to_console('Message has been sent');
                    $postData = '';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    $statusMsg = 'Failed! Something went wrong, please try again.'; 
                    debug_to_console('Message has NOT been sent');
                }
            } 
             
        } 
    }else{ 
        $valErr = !empty($valErr)?'<br/>'.trim($valErr, '<br/>'):''; 
        $statusMsg = 'Please fill all the mandatory fields.'.$valErr; 
    } 
}
?>