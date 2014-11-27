<?php

/* 
    Murdoch University - ICT333 - F03 - ISCon - TSA14

    Author: MyVi14
    Date: 1 November 2014
    Purpose: Controller for processing business logic for Supervisors
 */
class SupervisorController extends Controller {
    public function approve($ISCID) {
        $this->view('isc/approve', ["ISCID" => $ISCID, "who" => "supervisor"]);
    }
    
    public function disapprove($ISCID) {
        $ISCModel = $this->model("ISC");
        
        $status = $ISCModel->disapproveISC($ISCID, "supervisor");
        
        if($status == 1) {
            $confirmation = "You have successfully disapproved ISC " . $ISCID;
            $this->view('isc/confirmation', ["confirmation" => $confirmation]);
        }
    }
    
    public function submitAnswers($ISCID = '', $answer = []) {
        $ISCModel = $this->model("ISC");
        
        $status = $ISCModel->updateISCSupervisorAnswers($this->constituteISCSupervisorAnswers($ISCID, $answer));
        $ISCModel->approveISC($ISCID, "supervisor");
        
        $confirmation = "You have successfully approved ISC " . $ISCID;
        
        if($status == 1)
            $this->view('isc/confirmation', ["confirmation" => $confirmation]);
        else 
            $this->view('isc/confirmation', ["confirmation" => "Some error happend, try again"]);
    }
    
    public function updateAnswers($ISCID = '', $answer = []) {
        $ISCModel = $this->model("ISC");
        
        $status = $ISCModel->updateISCSupervisorAnswers($this->constituteISCSupervisorAnswers($ISCID, $answer));
        $confirmation = "You have successfully updated your answers for ISC " . $ISCID;
        
        if($status == 1)
            $this->view('isc/confirmation', ["confirmation" => $confirmation]);
        else 
            $this->view('isc/confirmation', ["confirmation" => "Some error happend, try again"]);
    }
    
    private function constituteISCSupervisorAnswers($ISCID = '', $answer = []) {
        $ISCModel = $this->model('ISC');
        $ISCModel->setISCID($ISCID);
        
        $item1Answer = $answer["item1"];
        $item1Comment = $answer["item1Comment"];
        $item2Answer = $answer["item2"];
        $item3Answer = $answer["item3"];
        $item3Comment = $answer["item3Comment"];
        $item4Answer = $answer["item4"];
        $item5aAnswer = $answer["item5a"];
        $item5bAnswer = $answer["item5b"];
        $item5cAnswer = $answer["item5c"];
        $item5dAnswer = $answer["item5d"];
        $item5eAnswer = $answer["item5e"];
        $item6Answer = $answer["item6"];
        $item7Answer = $answer["item7"];
        $item8Answer = $answer["item8"];
        $item9Answer = $answer["item9"];
        
        $ISCModel->addSupervisorAnswer("item1", $item1Answer, "", $item1Comment);
        $ISCModel->addSupervisorAnswer("item2", $item2Answer, "", "");
        $ISCModel->addSupervisorAnswer("item3", $item3Answer, "", $item3Comment);
        $ISCModel->addSupervisorAnswer("item4", $item4Answer, "", "");
        $ISCModel->addSupervisorAnswer("item5a", $item5aAnswer, "", "");
        $ISCModel->addSupervisorAnswer("item5b", $item5bAnswer, "", "");
        $ISCModel->addSupervisorAnswer("item5c", $item5cAnswer, "", "");
        $ISCModel->addSupervisorAnswer("item5d", $item5dAnswer, "", "");
        $ISCModel->addSupervisorAnswer("item5e", $item5eAnswer, "", "");
        $ISCModel->addSupervisorAnswer("item6", "", $item6Answer, "");
        $ISCModel->addSupervisorAnswer("item7", "", $item7Answer, "");
        $ISCModel->addSupervisorAnswer("item8", "", $item8Answer, "");
        $ISCModel->addSupervisorAnswer("item9", $item9Answer, "", "");
        
        return $ISCModel;
    }
    
    public function submitResults() {
        
    }
} // end SupervisorController

