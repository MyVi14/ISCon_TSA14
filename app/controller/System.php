<?php

/* 
    Murdoch University - ICT333 - F03 - ISCon - TSA14

    Author: MyVi14
    Date: 1 November 2014
    Purpose: Controller for processing use cases related to System agent
 */
class System {
    
    public function upload($componentID, $fileName,  $fileVariable) {
        $target_dir = ROOT_PATH . "app/upload/";
        $target_file = $target_dir . $componentID. $fileName;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        
        // Check if image file is a actual image or fake image
//        if(isset($_POST["submit"])) {
//            $check = getimagesize($_FILES["FileUpload"]["tmp_name"]);
//            if($check !== false) {
//                echo "File is an image - " . $check["mime"] . ".";
//                $uploadOk = 1;
//            } else {
//                echo "File is not an image.";
//                $uploadOk = 0;
//            }
//        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size, not larger than 100mb
        if ($_FILES[$fileVariable]["size"] > 100000000) {
            echo "Sorry, your file is too large, not larger than 100mb";
            $uploadOk = 0;
        }
        // Allow certain file formats
//        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//                && $imageFileType != "gif" ) {
//            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//            $uploadOk = 0;
//        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$fileVariable]["tmp_name"], $target_file)) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }
        
        return $uploadOk;
    }
    
    public function email($data = []) {
        
        $from= $data["fromEmail"]; 
        $fromName=$data["fromName"];
        $to=$data["toEmail"];
        $toName=$data["toName"];
        $subject=$data["subject"]; 
        $body=$data["body"];
        
//        $fileName = basename($_FILES["emailAttachment"]["name"]);
//        $target_dir = ROOT_PATH . "app/upload/";
//        $target_file = $target_dir . $fileName;
//        // upload file
//        $status = $this->upload('', $fileName, "emailAttachment");
        
        if ($from != '' && $to != '' && $body != '') {
            $this->sendEmail($from, $fromName, $subject, $body, $to, $toName);
        }
    }
    
    private function sendEmail($from='', $fromName='', $subject='', $body='', $to='', $toName='', $attachments=[]) {
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
        // Add attachments
        foreach ($attachments as $targetfile) {
            $mail->addAttachment($targetfile);
        }
        
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
            //$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
            $mail->Host = 'smtpcorp.com';             // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                     // Enable SMTP authentication
            $mail->Username = 'tieuhaphong91@gmail.com';// SMTP username
            $mail->Password = 'haphong285';        // SMTP password
            $mail->SMTPSecure = 'tls';                  // Enable encryption, 'ssl' also accepted
            $mail->Port = 2525;
        }
    }
} // end System class

