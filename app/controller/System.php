<?php

/* 
    Murdoch University - ICT333 - F03 - ISCon - TSA14

    Author: MyVi14
    Date: 1 November 2014
    Purpose: Controller for processing use cases related to System agent
 */
class System {
    
    public function sendEmail($from='', $fromName='', $subject='', $body='', $to='', $toName='', $attachment=[]) {
        require_once __DIR__ . '/../includes/phpmailer/class.phpmailer.php';
        
        $mail = new PHPMailer();
//        if ( !$mail->validateAddress($mail) ) {
//            echo 'Invalid email address.';
//            exit;
//        }
        
        // Setting serer information, using free smtp from gmail
        $this->setUpEmailServer($mail);    
        
        // add sender
        $mail->From = $from;
        $mail->FromName = $fromName;
        
        // Add a recipient, Name is optional
        if ($toName != null) {
            $mail->addAddress($to, $toName);
        }
        else {
            $mail->addAddress($to);
        }

        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body    = $body;

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    } // end sendEmail()
    
    public function convertResultToExcel() {
        
    }
    
    private function setUpEmailServer($mail = null) {
        if ($mail != null) {
            
            $mail->isSMTP();                            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                     // Enable SMTP authentication
            $mail->Username = 'tieuhaphong91@gmail.com';// SMTP username
            $mail->Password = 'thelonelywind9x';        // SMTP password
            $mail->SMTPSecure = 'tls';                  // Enable encryption, 'ssl' also accepted
        }
    }
} // end System class

