<?php
include_once dirname(__FILE__) . '/../da/ISCDA.php';
/* 
   Murdoch University - ICT333 - F03 - ISCon - TSA14

   Author: MyVi14
   Date: 1 September 2014
   Purpose: Representing an Indepdent Study Contract with basic information
*/
class ISC {
    private $ISCID;
    private $applicationType;
    private $applicationStatus;
    private $createdDate;
    private $surname;
    private $givenName;
    private $studentNo;
    private $email;
    private $phoneNo;
    private $confirmMaximumISC;
    private $enrollInPHD;
    private $additionalComment;
    
    // associative array
    private $associateSupervisor;
    private $supervisor;
    private $academicChair;
    private $schoolDean;
    private $supervisorAnswer = array();
    
    public function __construct() {
        
    }
    
    public function createISC($applicationType, $surname, $givenName, $studentNo, $email, $phoneNo, $confirmMaximumISC, $enrollInPHD) {
        return ISCDA::createISC($applicationType, "New", $surname, $givenName, $studentNo, $email, $phoneNo, $confirmMaximumISC, $enrollInPHD);
    }
    
    public static function updateISC($ISC) {
        return ISCDA::updateISC($ISC);
    }
    
    public static function approveISC($ISCID, $who) {
        if (strtolower($who) == "supervisor" ) {
            $status = "Supervisor Approved";
        } else if (strtolower($who) == "school dean") {
            $status = "SD Approved";
        } else if (strtolower($who) == "academic chair") {
            $status = "AC Approved";
        }
        
        return ISCDA::approveISC($ISCID, $status);
    }
    
    public static function disapproveISC($ISCID, $who) {
        if (strtolower($who) == "supervisor" ) {
            $status = "Supervisor Not Approved";
        } else if (strtolower($who) == "school dean") {
            $status = "SD Not Approved";
        } else if (strtolower($who) == "academic chair") {
            $status = "AC Not Approved";
        }
        
        return ISCDA::disapproveISC($ISCID, $status);
    }
    
    public static function giveReason($ISCID, $reason) {
        ISCDA::giveReason($ISCID, $reason);
    }
    
    public static function addISCSupervisorAnswer($ISC) {
        return ISCDA::addSupervisorAnswers($ISC->getISCID(), $ISC->getSupervisorAnswer());
    }
    
    public static function updateISCSupervisorAnswers($ISC) {
        return ISCDA::updateSupervisorAnswers($ISC->getISCID(), $ISC->getSupervisorAnswer());
    }
    
    public function addSupervisorAnswer($itemID, $yesNoAnswer, $textAnswer, $comment) {
        $supervisorAnswer = array("itemID" => $itemID,
                                "yesNoAnswer" => $yesNoAnswer,
                                "textAnswer" => $textAnswer,
                                "comment" => $comment,
                                );
        
        array_push($this->supervisorAnswer, $supervisorAnswer);
    }
    
    public function addSupervisor($title, $surname, $givenName, $position, $school, $email) {
        $supervisorInfo = array("title"=>$title,
                                "surname"=>$surname,
                                "givenName"=>$givenName,
                                "position"=>$position,
                                "school"=>$school,
                                "email"=>$email
                                );
        
        $this->setSupervisor($supervisorInfo);
    }
    
    public function addAssociateSupervisor($title, $surname, $givenName, $position, $school, $email) {
        $associateInfo = array("title"=>$title,
                                "surname"=>$surname,
                                "givenName"=>$givenName,
                                "position"=>$position,
                                "school"=>$school,
                                "email"=>$email
                                );
        
        $this->setAssociateSupervisor($associateInfo);
    }
    
    public function addAcademicChair($surname, $givenName, $unitCode, $email) {
        $academicChairInfo = array("surname"=>$surname,
                                "givenName"=>$givenName,
                                "unitCode"=>$unitCode,
                                "email"=>$email
                                );
        
        $this->setAcademicChair($academicChairInfo);
    }
    
    public function addSchoolDean($surname, $givenName, $school, $email) {
        $schoolDeanInfo = array("surname"=>$surname,
                                "givenName"=>$givenName,
                                "school"=>$school,
                                "email"=>$email
                                );
        
        $this->setSchoolDean($schoolDeanInfo);
    }
    
    public function getISCList() {
        $iscs = ISCDA::retrieveISCList();
        $ISCList = array();
        
        foreach ($iscs as $isc) {
            $newISC = $this->newInstance($isc["ISCID"], 
                                        $isc["ApplicationType"], 
                                        $isc["ApplicationStatus"], 
                                        $isc["CreatedDate"],
                                        $isc["Surname"], 
                                        $isc["GivenName"], 
                                        $isc["StudentNo"], 
                                        $isc["Email"], 
                                        $isc["PhoneNo"]);
            $newISC->setAdditionalComment($isc["AdditionalComment"]);
            array_push($ISCList, $newISC);
        }
        
        return $ISCList;
    }
    
    public function newInstance($ISCID, $applicationType, $applicationStatus, $createdDate, $surname, $givenName, $studentNo, $email, $phoneNo) {
        $newISC = new ISC();
        
        $newISC->setISCID($ISCID);
        $newISC->setApplicationType($applicationType);
        $newISC->setApplicationStatus($applicationStatus);
        $newISC->setCreatedDate($createdDate);
        $newISC->setSurname($surname);
        $newISC->setGivenName($givenName);
        $newISC->setStudentNo($studentNo);
        $newISC->setEmail($email);
        $newISC->setPhoneNo($phoneNo);
        
        return $newISC;
    }
    
    public function setISC($ISCID, $applicationType, $applicationStatus, $createdDate, 
            $surname, $givenName, $studentNo, $email, $phoneNo, $confirmMaximumISC, $enrollInPHD) {
        $this->setISCID($ISCID);
        $this->setApplicationType($applicationType);
        $this->setApplicationStatus($applicationStatus);
        $this->setCreatedDate($createdDate);
        $this->setSurname($surname);
        $this->setGivenName($givenName);
        $this->setStudentNo($studentNo);
        $this->setEmail($email);
        $this->setPhoneNo($phoneNo);
        $this->setConfirmMaximumISC($confirmMaximumISC);
        $this->setEnrollInPHD($enrollInPHD);
    }
    
    function getISCID() {
        return $this->ISCID;
    }

    function getApplicationType() {
        return $this->applicationType;
    }

    function getApplicationStatus() {
        return $this->applicationStatus;
    }

    function getCreatedDate() {
        return $this->createdDate;
    }

    function getSurname() {
        return $this->surname;
    }

    function getGivenName() {
        return $this->givenName;
    }

    function getStudentNo() {
        return $this->studentNo;
    }

    function getEmail() {
        return $this->email;
    }

    function getPhoneNo() {
        return $this->phoneNo;
    }

    function setISCID($ISCID) {
        $this->ISCID = $ISCID;
    }

    function setApplicationType($applicationType) {
        $this->applicationType = $applicationType;
    }

    function setApplicationStatus($applicationStatus) {
        $this->applicationStatus = $applicationStatus;
    }

    function setCreatedDate($createdDate) {
        $this->createdDate = $createdDate;
    }

    function setSurname($surname) {
        $this->surname = $surname;
    }

    function setGivenName($givenName) {
        $this->givenName = $givenName;
    }

    function setStudentNo($studentNo) {
        $this->studentNo = $studentNo;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPhoneNo($phoneNo) {
        $this->phoneNo = $phoneNo;
    }
    
    function getConfirmMaximumISC() {
        return $this->confirmMaximumISC;
    }

    function getEnrollInPHD() {
        return $this->enrollInPHD;
    }

    function getAssociateSupervisor() {
        return $this->associateSupervisor;
    }

    function getSupervisor() {
        return $this->supervisor;
    }

    function getAcademicChair() {
        return $this->academicChair;
    }

    function getSchoolDean() {
        return $this->schoolDean;
    }

    function setConfirmMaximumISC($confirmMaximumISC) {
        $this->confirmMaximumISC = $confirmMaximumISC;
    }

    function setEnrollInPHD($enrollInPHD) {
        $this->enrollInPHD = $enrollInPHD;
    }

    function setAssociateSupervisor($associateSupervisor) {
        $this->associateSupervisor = $associateSupervisor;
    }

    function setSupervisor($supervisor) {
        $this->supervisor = $supervisor;
    }

    function setAcademicChair($academicChair) {
        $this->academicChair = $academicChair;
    }

    function setSchoolDean($schoolDean) {
        $this->schoolDean = $schoolDean;
    }

    function getSupervisorAnswer() {
        return $this->supervisorAnswer;
    }
    
    function getAdditionalComment() {
        return $this->additionalComment;
    }

    function setAdditionalComment($additionalComment) {
        $this->additionalComment = $additionalComment;
    }



} // end class ISC

