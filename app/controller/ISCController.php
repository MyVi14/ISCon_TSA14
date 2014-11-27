<?php

/* 
    Murdoch University - ICT333 - F03 - ISCon - TSA14

    Author: MyVi14
    Date: 1 November 2014
    Purpose: Controller for processing business logic for Indenpendent Study Contract
 */
class ISCController extends Controller {
    
    /* Interface functions. Will appear on URL */
    
    public function create($newISC = []) {
        $this->view('isc/create', $newISC);
        
    }
    
    public function get($ISCID = '', $who = '') {
        $this->view('isc/detail', ["ISCID" => $ISCID, "who" => $who]);
    }
    
    public function update($ISCID = '', $ISC = []) {
        $status = $this->updateISC($ISCID, $ISC);
        $status = $this->updateISCDetail($ISCID, $ISC);
        
        if($status == 1) {
            $confirmation = "You have successfully updated ISC " . $ISCID;
            $this->view('isc/confirmation', ["confirmation" => $confirmation]);
        } else {
            $this->view('isc/confirmation', ["confirmation" => "Some problem occured, try again!"]);
        }
    }
    
    public function assessmentComponent($ISCID = '', $who = '') {
        $ISC = $this->model('ISCDetail');
        
        $components = $ISC->retrieveAssessmentComponents($ISCID);
        $this->view('isc/assessmentComponent', ["ISCID" => $ISCID, "components" => $components, "who" => $who]);
    }
    
    public function submitComponent($componentID = '', $component = []) {
        require_once 'System.php';
        
        $ISCID = $component["ISCID"];
        $fileName = $componentID . "-" . basename($_FILES["FileUpload"]["name"]);
        
        $system = new System();
        
        // upload file
        $status = $system->upload($componentID, $fileName, "FileUpload");
        
        // save to database
        if ($status == 1) {
            $ISCModel = $this->model('ISCDetail');
            $editedRecord = $ISCModel->saveAssessmentComponentFileUpload($componentID, $fileName);
            
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            echo 'Cannot upload file. Start again';
        }
    }
    
    public function submitResult($componentID, $result = []) {
        $mark = trim($result["mark" . $componentID]);
        $comment = trim($result["comment" . $componentID]);
        
        $ISCModel = $this->model('ISCDetail');
        $editedRecord = $ISCModel->submitResult($componentID, $mark, $comment);
        
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
    
    /* Support functions */
    
    public function createISC($newISC = []) {
        $ISC = $this->model('ISCDetail');
            
        $newISCID = $ISC->createISC(
                                    $newISC["applicationType"],
                                    $newISC["studentSurname"],
                                    $newISC["studentGivenName"],
                                    $newISC["studentNo"],
                                    $newISC["studentEmail"],
                                    $newISC["studentPhoneNo"],
                                    $newISC["confirmMaximumISC"],
                                    $newISC["enrollInPHD"]
                                    );
        
        return $newISCID;
    }
    
    public function getISCList() {
        $ISC = $this->model('ISC');
        
        $ISCList = $ISC->getISCList();
        
        //$this->view('home/studentHome', $ISCList);
        
        return $ISCList;
    }
    
    public function updateISC($ISCID, $ISC = []) {
        $ISCObj = $this->model('ISC');
        
        $ISCObj->setISC($ISCID,
                        $ISC["applicationType"],
                        $ISC["applicationStatus"],
                        '',
                        $ISC["studentSurname"],
                        $ISC["studentGivenName"],
                        $ISC["studentNo"],
                        $ISC["studentEmail"],
                        $ISC["studentPhoneNo"],
                        $ISC["confirmMaximumISC"],
                        $ISC["enrollInPHD"]
                        );
        
        $ISCObj->updateISC($ISCObj);
    }
    
    public function updateISCDetail($ISCID, $ISC = []) {
        $ISCDetail = $this->model('ISCDetail');
        
        // pass data to constitute ISC Detail object
        
        $ISCDetail->setISCDetail($ISCID, $ISC["courseName"], $ISC["creditPoint"], $ISC["contractTitle"], 
                        $ISC["isAReplacement"], $ISC["learningObjectives"], $ISC["projectOutline"], 
                        $ISC["previousStudy"], $ISC["previousExperience"], $ISC["contractLevel"], 
                        $ISC["studyMode"], $ISC["campusLocation"], $ISC["teachingPeriod"]);
        
        $ISCDetail->addSupervisor($ISC["supervisorTitle"], 
                                    $ISC["supervisorSurname"],
                                    $ISC["supervisorGivenName"],
                                    $ISC["supervisorPosition"],
                                    $ISC["supervisorSchool"],
                                    $ISC["supervisorEmail"]);
        
        // associate supervisor
        $ISCDetail->addAssociateSupervisor($ISC["associateTitle"], 
                                    $ISC["associateSurname"],
                                    $ISC["associateGivenName"],
                                    $ISC["associatePosition"],
                                    $ISC["associateSchool"],
                                    $ISC["associateEmail"]);
        
        // academic chair
        if (strtolower($ISCDetail->getIsAReplacement()) == 'yes') {
            $ISCDetail->addAcademicChair($ISC["academicChairSurname"], 
                                    $ISC["academicChairGivenName"],
                                    $ISC["academicChairUnitCode"],
                                    $ISC["academicChairEmail"]);
            
            // replacement
            $ISCDetail->addReplacement($ISC["replacementUnitCode"],$ISC["replacementUnitTitle"],$ISC["replacementCoreOrElective"]);
        }
        
        // school dean
        $ISCDetail->addSchoolDean($ISC["schoolDeanSurname"], 
                                $ISC["schoolDeanGivenName"], 
                                $ISC["schoolDeanSchool"], 
                                $ISC["schoolDeanEmail"]);
        
        if (isset($ISC["expectedActivities"])) {
            // expected activities
            foreach($ISC["expectedActivities"] as $expectedActivity) {
                $ISCDetail->addExpectedActivity($expectedActivity, "");
            }
        }
        
        // reading list
        for($index = 0; $index < count($ISC["readingListTitle"]); $index++ ) {
            $ISCDetail->addReadingList($ISC["readingListAuthor"][$index], $ISC["readingListTitle"][$index], $ISC["readingListPublicationDate"][$index]);
        }
        
        // assessment components
        for($index = 0; $index < count($ISC["number"]); $index++ ) {
            $ISCDetail->addAssessmentCommponent($ISC["componentDescription"][$index], $ISC["componentWordLength"][$index], 
                                                $ISC["componentPercentage"][$index], $ISC["componentDueDate"][$index], '');
            
        }
        
        $status = $ISCDetail->updateISCDetail($ISCDetail);
        
        return $status;
    }
    
    public function getISC($ISCID) {
        $ISCModel = $this->model('ISCDetail');
        
        $ISCDetail = $ISCModel->getISC($ISCID);
        
        return $ISCDetail;
    }
    
    public function approve($ISCID = '', $who = '') {
        $ISCModel = $this->model('ISCDetail');
        if ($ISCID != '' && $who != '')
            $ISCModel->approveISC($ISCID, $who);
    }
    
    public function disapproveISC($ISCID = '', $who = '') {
        $ISCModel = $this->model('ISCDetail');
        if ($ISCID != '' && $who != '')
            $ISCModel->disapproveISC($ISCID, $who);
    }
    
    
    
} // end ISCController

