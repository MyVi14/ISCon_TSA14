<?php
/* 
    Murdoch University - ICT333 - F03 - ISCon - TSA14

    Author: MyVi14
    Date: 1 November 2014
    Purpose: Provide common functions for school dean users
*/
class SchoolDeanController extends Controller {
    public function approve($ISCID) {
        $ISCModel = $this->model("ISC");
        
        $status = $ISCModel->approveISC($ISCID, "school dean");
        
        if($status == 1) {
            // send email
            $ISCDetail = $this->model("ISCDetail");
            
            $ISCDetail = $ISCDetail::getISC($ISCID);
            
            require_once 'System.php';
            $sys = new System();
            
            // email to student
            $sys->email(array(
                "fromEmail" => "tieuhaphong91@gmail.com",
                "fromName" => "Independent Study Portal",
                "toEmail" => $ISCDetail->getEmail(),
                "toName" => $ISCDetail->getSurname() . " " . $ISCDetail->getGivenName(),
                "subject" => "Independent Study Contract Portal: Your ISC is approved!",
                "body" => "School Dean has recently approved your ISC. Please click here to review:\n" . URL_PREFIX . "public/ISCController/get/".$ISCID."/student"
            ));
            
            $confirmation = "You have successfully approved ISC " . $ISCID;
            $this->view('isc/confirmation', ["confirmation" => $confirmation]);
        } else {
            $this->view('isc/confirmation', ["confirmation" => "Problems occured! Try again"]);
        }
    }
    
    public function disapprove($data = []) {
        $ISCID = $data["ISCID"];
        $reason = $data["reason"];
        
        $ISCModel = $this->model("ISCDetail");
        
        $ISCModel->giveReason($ISCID, $reason);
        $status = $ISCModel->disapproveISC($ISCID, "school dean");
        
        if($status == 1) {
            $ISCDetail = $ISCModel::getISC($ISCID);
            // email to student
            require_once 'System.php';
            $sys = new System();
            $sys->email(array(
                "fromEmail" => "tieuhaphong91@gmail.com",
                "fromName" => "Independent Study Portal",
                "toEmail" => $ISCDetail->getEmail(),
                "toName" => $ISCDetail->getSurname() . " " . $ISCDetail->getGivenName(),
                "subject" => "Independent Study Contract Portal: Your ISC is approved!",
                "body" => "School Dean has recently disapproved your ISC. Please click here to review:\n" . URL_PREFIX . "public/ISCController/get/".$ISCID."/student"
            ));
            
            $confirmation = "You have successfully disapproved ISC " . $ISCID . "!";
            //$this->view('isc/confirmation', ["confirmation" => $confirmation]);
        } else {
            $this->view('isc/confirmation', ["confirmation" => "Problems occured! Try again"]);
        }
        
        echo $confirmation;
    }
    
    public function reason($ISCID) {
        $this->view("pageComponent/reason", ["ISCID" => $ISCID]);
    }
    
    public function giveReason($data = []) {
        $ISCID = $data["ISCID"];
        $reason = $data["reason"];
        
        echo $ISCID . " " . $reason;
    }
} // end SchoolDeanController
?>

