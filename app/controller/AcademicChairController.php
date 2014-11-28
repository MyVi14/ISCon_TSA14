<?php

/* 
    Murdoch University - ICT333 - F03 - ISCon - TSA14

    Author: MyVi14
    Date: 1 November 2014
    Purpose: Provide common functions for academic chair users
*/
class AcademicChairController extends Controller {
    public function approve($ISCID) {
        $ISCModel = $this->model("ISC");
        
        $status = $ISCModel->approveISC($ISCID, "academic chair");
        
        if($status == 1) {
            // send email
            $ISCDetail = $this->model("ISCDetail");
            
            $ISCDetail = $ISCDetail::getISC($ISCID);
            
            require_once 'System.php';
            $sys = new System();
            
            // email to supervisor
            $sys->email(array(
                "fromEmail" => "tieuhaphong91@gmail.com",
                "fromName" => "Independent Study Portal",
                "toEmail" => $ISCDetail->getSupervisor()["email"],
                "toName" => $ISCDetail->getSupervisor()["surname"] . " " . $ISCDetail->getSupervisor()["givenName"],
                "subject" => "Independent Study Contract Portal: An ISC needs your attention!",
                "body" => "Academic chair has recently approved an ISC that needs your supervision. Please click here to review:\n" . URL_PREFIX . "public/ISCController/get/".$ISCID."/supervisor"
            ));
            
            // email to associate supervisor if applicable
            if (isset($ISC["associateEmail"])) {
                $sys->email(array(
                    "fromEmail" => "tieuhaphong91@gmail.com",
                    "fromName" => "Independent Study Portal",
                    "toEmail" => $ISCDetail->getAssociateSupervisor()["email"],
                    "toName" => $ISCDetail->getAssociateSupervisor()["surname"] . " " . $ISCDetail->getAssociateSupervisor()["givenName"],
                    "subject" => "Independent Study Contract Portal: An ISC needs your attention!",
                    "body" => "Academic chair has recently approved an ISC that needs your supervision. Please click here to review ISC:\n" . URL_PREFIX . "public/ISCController/get/".$ISCID."/supervisor"
                ));
            }
                
            // send confirmation
            $confirmation = "You have successfully approved ISC " . $ISCID;
            $this->view('isc/confirmation', ["confirmation" => $confirmation]);
        } else {
            $this->view('isc/confirmation', ["confirmation" => "Problems occured! Try again"]);
        }
    }
    
    public function disapprove($ISCID) {
        $ISCModel = $this->model("ISCDetail");
        
        $status = $ISCModel->disapproveISC($ISCID, "academic chair");
        
        if($status == 1) {
            // send email
            
            $ISCDetail = $ISCModel::getISC($ISCID);
            require_once 'System.php';
            $sys = new System();
            // email to supervisor
            $sys->email(array(
                "fromEmail" => "tieuhaphong91@gmail.com",
                "fromName" => "Independent Study Portal",
                "toEmail" => $ISCDetail->getSupervisor()["email"],
                "toName" => $ISCDetail->getSupervisor()["surname"] . " " . $ISCDetail->getSupervisor()["givenName"],
                "subject" => "Independent Study Contract Portal: An ISC needs your attention!",
                "body" => "Academic chair has recently disapproved an ISC that needs your supervision. Please click here to review:\n" . URL_PREFIX . "public/ISCController/get/".$ISCID."/supervisor"
            ));
            
            // email to associate supervisor if applicable
            if (isset($ISC["associateEmail"])) {
                $sys->email(array(
                    "fromEmail" => "tieuhaphong91@gmail.com",
                    "fromName" => "Independent Study Portal",
                    "toEmail" => $ISCDetail->getAssociateSupervisor()["email"],
                    "toName" => $ISCDetail->getAssociateSupervisor()["surname"] . " " . $ISCDetail->getAssociateSupervisor()["givenName"],
                    "subject" => "Independent Study Contract Portal: An ISC needs your attention!",
                    "body" => "Academic chair has recently disapproved an ISC that needs your supervision. Please click here to review ISC:\n" . URL_PREFIX . "public/ISCController/get/".$ISCID."/supervisor"
                ));
            }
            
            $confirmation = "You have successfully disapproved ISC " . $ISCID;
            $this->view('isc/confirmation', ["confirmation" => $confirmation]);
        } else {
            $this->view('isc/confirmation', ["confirmation" => "Problems occured! Try again"]);
        }
    }
} // end AcademicChairController
?>

