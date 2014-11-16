<?php

/* 
    Murdoch University - ICT333 - F03 - ISCon - TSA14

    Author: MyVi14
    Date: 1 November 2014
    Purpose: Controller for processing business logic for Indenpendent Study Contract
 */
class ISCController extends Controller {
    
    public function create($newISC = []) {
        $this->view('isc/create', $newISC);
        
//        if($newISC == NULL) {
//            $this->view('isc/create', null);
//        } else {   
//            //header("Location: " . BASE_URL . "public/home/student");
//        }
    }
    
    public function get($ISCID = '') {
        $this->view('isc/detail', ["ISCID" => $ISCID]);
    }
    
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
        
        // expected activities
        foreach($ISC["expectedActivities"] as $expectedActivity) {
            $ISCDetail->addExpectedActivity($expectedActivity, "");
        }
        
        // reading list
        for($index = 0; $index < count($ISC["readingListTitle"]); $index++ ) {
            $ISCDetail->addReadingList($ISC["readingListAuthor"][$index], $ISC["readingListTitle"][$index], $ISC["readingListPublicationDate"][$index]);
        }
        
        // assessment components
        for($index = 0; $index < count($ISC["number"]); $index++ ) {
            $ISCDetail->addAssessmentCommponent($ISC["componentDescription"][$index], $ISC["componentWordLength"][$index], 
                                                $ISC["componentPercentage"][$index], $ISC["componentDueDate"][$index]);
            
        }
        
        //var_dump($ISC);
        //var_dump($ISCDetail->getSchoolDean());
        //echo $ISC["schoolDeanEmail"];
        $status = $ISCDetail->updateISCDetail($ISCDetail);
        
        return $status;
    }
    
    public function getISC($ISCID) {
        $ISCModel = $this->model('ISCDetail');
        
        $ISCDetail = $ISCModel->getISC($ISCID);
        
        return $ISCDetail;
    }
    
    public function submit($ISCID='', $who = '') {
    }
    
    public function approve($ISCID = '', $status = '', $who = '') {
        
    }
    
    public function submitComponents($ISCID = '', $components = []) {
        echo 'submit components;';
    }
    
}

