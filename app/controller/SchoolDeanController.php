<?php

class SchoolDeanController extends Controller {
    public function approve($ISCID) {
        $ISCModel = $this->model("ISC");
        
        $status = $ISCModel->approveISC($ISCID, "school dean");
        
        if($status == 1) {
            $confirmation = "You have successfully approved ISC " . $ISCID;
            $this->view('isc/confirmation', ["confirmation" => $confirmation]);
        }
    }
    
    public function disapprove($ISCID, $data = []) {
        $ISCModel = $this->model("ISC");
        
        $ISCModel->giveReason($ISCID, $data["reason"]);
        $status = $ISCModel->disapproveISC($ISCID, "school dean");
        
        if($status == 1) {
            $confirmation = "You have successfully disapproved ISC " . $ISCID;
            $this->view('isc/confirmation', ["confirmation" => $confirmation]);
        }
    }
    
    public function reason($ISCID) {
        $this->view("pageComponent/reason", ["ISCID" => $ISCID]);
    }
}
?>

