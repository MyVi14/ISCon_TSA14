<?php

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
            
            // email to school dean
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
        }
    }
    
    public function disapprove($data = []) {
        $ISCID = $data["ISCID"];
        $reason = $data["reason"];
        
        $ISCModel = $this->model("ISC");
        
        $ISCModel->giveReason($ISCID, $reason);
        $status = $ISCModel->disapproveISC($ISCID, "school dean");
        
        if($status == 1) {
            $confirmation = "You have successfully disapproved ISC " . $ISCID . "!";
            //$this->view('isc/confirmation', ["confirmation" => $confirmation]);
        } else {
            $confirmation = "Some errors occured! Can you start again?";
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

