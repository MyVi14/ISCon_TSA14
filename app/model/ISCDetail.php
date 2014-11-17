<?php
include_once 'ISC.php';
include_once dirname(__FILE__) . '/../da/ISCDA.php';
/* 
   Murdoch University - ICT333 - F03 - ISCon - TSA14

   Author: MyVi14
   Date: 1 September 2014
   Purpose: Representing details about an Indepdent Study Contract
*/
class ISCDetail extends ISC {
    private $courseName;
    private $creditPoint = -1;
    private $contractTitle;
    private $isAReplacement;
    private $learningObjectives;
    private $projectOutline;
    private $previousStudy;
    private $previousExperience;
    private $contractLevel;
    private $studyMode;
    private $campusLocation;
    private $teachingPeriod;
    
    // associative array
    private $replacement;
    private $expectedActivities = array();
    private $readingList = array();
    private $assessmentComponents = array();
    
    public function setISCDetail($ISCID, $courseName, $creditPoint, $contractTitle, $isAReplacement, 
                        $learningObjectives, $projectOutline, $previousStudy, $previousExperience, 
                        $contractLevel, $studyMode, $campusLocation, $teachingPeriod) {
        
        parent::setISCID($ISCID);
        $this->setCourseName($courseName);
        $this->setCreditPoint($creditPoint);
        $this->setContractTitle($contractTitle);
        $this->setIsAReplacement($isAReplacement);
        $this->setLearningObjectives($learningObjectives);
        $this->setProjectOutline($projectOutline);
        $this->setPreviousStudy($previousStudy);
        $this->setPreviousExperience($previousExperience);
        $this->setContractLevel($contractLevel);
        $this->setStudyMode($studyMode);
        $this->setCampusLocation($campusLocation);
        $this->setTeachingPeriod($teachingPeriod);
    }

    public static function updateISCDetail($ISCDetail) {
        return ISCDA::updateISCDetail($ISCDetail);
    }
    
    public static function getISC($ISCID) {
        return ISCDA::getISC($ISCID);
    }
    
    public static function retrieveAssessmentComponents($ISCID) {
        return ISCDA::retrieveAssessmentComponents($ISCID);
    }
    
    public static function saveAssessmentComponentFileUpload($componentID, $fileName) {
        return ISCDA::saveAssessmentComponentFileUpload($componentID, $fileName);
    }
    
    public static function submitResult($componentID, $mark, $comment) {
        return ISCDA::submitResult($componentID, $mark, $comment);
    }
    
    public function addReplacement($unitCode, $title, $coreOrElective) {
        $replacement = array("unitCode" => $unitCode, "title" => $title, "coreOrElective" => $coreOrElective);
        
        $this->setReplacement($replacement);
    }
    
    public function addExpectedActivity($name, $description) {
        $expectedActivity = array("name" => $name, "description" => $description);
        array_push($this->expectedActivities, $expectedActivity);
    }
    
    public function addReadingList($author, $title, $publicationDate) {
        $readingList = array("author" => $author, "title" => $title, "publicationDate" => $publicationDate);
        array_push($this->readingList, $readingList);
    }
    
    public function addAssessmentCommponent($description, $wordLength, $percentage, $dueDate, $fileUpload) {
        $assessmentComponent = array("description" => $description, "wordLength" => $wordLength, 
                                    "percentage" => $percentage, "dueDate" => $dueDate, "fileUpload" => $fileUpload);
        array_push($this->assessmentComponents, $assessmentComponent);
    }
    
    function getReplacement() {
        return $this->replacement;
    }

    function setReplacement($replacement) {
        $this->replacement = $replacement;
    }

    function getCourseName() {
        return $this->courseName;
    }

    function getCreditPoint() {
        return $this->creditPoint;
    }

    function getContractTitle() {
        return $this->contractTitle;
    }

    function getIsAReplacement() {
        return $this->isAReplacement;
    }

    function getLearningObjectives() {
        return $this->learningObjectives;
    }

    function getProjectOutline() {
        return $this->projectOutline;
    }

    function getPreviousStudy() {
        return $this->previousStudy;
    }

    function getPreviousExperience() {
        return $this->previousExperience;
    }

    function getContractLevel() {
        return $this->contractLevel;
    }

    function getStudyMode() {
        return $this->studyMode;
    }

    function getCampusLocation() {
        return $this->campusLocation;
    }

    function getTeachingPeriod() {
        return $this->teachingPeriod;
    }

    function setCourseName($courseName) {
        $this->courseName = $courseName;
    }

    function setCreditPoint($creditPoint) {
        $this->creditPoint = $creditPoint;
    }

    function setContractTitle($contractTitle) {
        $this->contractTitle = $contractTitle;
    }

    function setIsAReplacement($isAReplacement) {
        $this->isAReplacement = $isAReplacement;
    }

    function setLearningObjectives($learningObjectives) {
        $this->learningObjectives = $learningObjectives;
    }

    function setProjectOutline($projectOutline) {
        $this->projectOutline = $projectOutline;
    }

    function setPreviousStudy($previousStudy) {
        $this->previousStudy = $previousStudy;
    }

    function setPreviousExperience($previousExperience) {
        $this->previousExperience = $previousExperience;
    }

    function setContractLevel($contractLevel) {
        $this->contractLevel = $contractLevel;
    }

    function setStudyMode($studyMode) {
        $this->studyMode = $studyMode;
    }

    function setCampusLocation($campusLocation) {
        $this->campusLocation = $campusLocation;
    }

    function setTeachingPeriod($teachingPeriod) {
        $this->teachingPeriod = $teachingPeriod;
    }
    
    function getExpectedActivities() {
        return $this->expectedActivities;
    }

    function getReadingList() {
        return $this->readingList;
    }

    function getAssessmentComponents() {
        return $this->assessmentComponents;
    }



} // end ISCDetail

