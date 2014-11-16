<?php

class AcademicChairController extends Controller {
    public function approve($ISCID) {
        $ISCModel = $this->model("ISC");
        
        $status = $ISCModel->sapproveISC($ISCID, "academic chair");
        
        if($status == 1) {
            $confirmation = "You have successfully approved ISC " . $ISCID;
            $this->view('isc/confirmation', ["confirmation" => $confirmation]);
        }
    }
    
    public function disapprove($ISCID) {
        $ISCModel = $this->model("ISC");
        
        $status = $ISCModel->disapproveISC($ISCID, "academic chair");
        
        if($status == 1) {
            $confirmation = "You have successfully disapproved ISC " . $ISCID;
            $this->view('isc/confirmation', ["confirmation" => $confirmation]);
        }
    }
}
?>

