<?php
require_once 'Connection.php';
/* 
   Murdoch University - ICT333 - F03 - ISCon - TSA14

   Author: MyVi14
   Date: 22 September 2014
   Purpose: Responsible for querying databases
*/
class ISCDA {
    public static function approveISC($ISCID, $status) {
        return ISCDA::updateISCStatus($ISCID, $status);
    }
        
    public static function disapproveISC($ISCID, $status) {
        return ISCDA::updateISCStatus($ISCID, $status);
    }
    
    public static function giveReason($ISCID, $reason) {
        // connect to database
        $PDOConn = Connection::getConnection();

        try {
            $status = $PDOConn->exec("update SCHOOL_DEAN set AdditionalComment = '".$reason."' where ISCID = '" . $ISCID . "'");
        } catch (Exception $ex) {
            echo $query . ' :Cannot give reason!';
            echo $ex->getMessage();
            exit;
        }
        
        return $status;
    }
    
    private static function updateISCStatus($ISCID, $status) {
        // connect to database
        $PDOConn = Connection::getConnection();

        try {
            $status = $PDOConn->exec("update ISCView set ISCView.ApplicationStatus = '".$status."' where ISCID = '" . $ISCID . "'");
        } catch (Exception $ex) {
            echo $query . ' :Cannot update ISC status!';
            echo $ex->getMessage();
            exit;
        }
        
        return $status;
    }
    
    public static function retrieveISCList() {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        $query = "select * from ISCView";
        try {
            $results = $PDOConn->prepare($query);
            //$results->bindParam();
            $results->execute();
        } catch (Exception $ex) {
            echo $query . ' :Cannot retrieve ISCList!';
            echo $ex->getMessage();
            exit;
        }
        
        $iscs = $results->fetchAll(PDO::FETCH_ASSOC);
        
        return $iscs;
    }
    
    public static function createISC($applicationType, $applicationStatus, $surname, $givenName, $studentNo, $email, $phoneNo, $confirmMaximumISC, $enrollInPHD) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        $query = "call CreateNewISC(:applicationType, :applicationStatus, :surname, :givenName, "
                . ":studentNo, :email, :phoneNo, :confirmMaximumISC, :enrollInPHD, @newISCID);";
        try {
            $results = $PDOConn->prepare($query);
            $results->bindParam(':applicationType', $applicationType);
            $results->bindParam(':applicationStatus', $applicationStatus);
            $results->bindParam(':surname', $surname);
            $results->bindParam(':givenName', $givenName);
            $results->bindParam(':studentNo', $studentNo);
            $results->bindParam(':email', $email);
            $results->bindParam(':phoneNo', $phoneNo);
            $results->bindParam(':confirmMaximumISC', $confirmMaximumISC);
            $results->bindParam(':enrollInPHD', $enrollInPHD);
            $results->execute();
            
            // execute the second query to get new ISC ID
            $query = "select @newISCID as newISCID";
            $r = $PDOConn->query($query)->fetch(PDO::FETCH_ASSOC);
            
        } catch (Exception $ex) {
            echo $query . ' :Cannot create new ISC!';
            echo $ex->getMessage();
            exit;
        }
        
        return $r["newISCID"];
    }
    
    public static function addSupervisorAnswers($ISCID = '', $SupervisorAnswerArray = []) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        try {
            $query = "call AddISCSupervisorAnswer(:ISCID, :ItemID, :YesNoAnswer, :TextAnswer, :Comment)";
            $results = $PDOConn->prepare($query);
            $results->bindParam(':ISCID', $ISCID);
            
            foreach ($SupervisorAnswerArray as $answer) {
                
                $results->bindParam(':ItemID', $answer["itemID"]);
                $results->bindParam(':YesNoAnswer', $answer["yesNoAnswer"]);
                $results->bindParam(':TextAnswer', $answer["textAnswer"]);
                $results->bindParam(':Comment', $answer["comment"]);

                $status= $results->execute();
            }
        } catch (Exception $ex) {
            echo $query . ' :Cannot add ISC supervisor answer!';
            echo $ex->getMessage();
            exit;
        }
        
        return $status;
    }
    
    public static function updateSupervisorAnswers($ISCID = '', $SupervisorAnswerArray = []) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        try {
            $query = "call UpdateISCSupervisorAnswer(:ISCID, :ItemID, :YesNoAnswer, :TextAnswer, :Comment)";
            $results = $PDOConn->prepare($query);
            $results->bindParam(':ISCID', $ISCID);
            
            foreach ($SupervisorAnswerArray as $answer) {
                
                $results->bindParam(':ItemID', $answer["itemID"]);
                $results->bindParam(':YesNoAnswer', $answer["yesNoAnswer"]);
                $results->bindParam(':TextAnswer', $answer["textAnswer"]);
                $results->bindParam(':Comment', $answer["comment"]);

                $status= $results->execute();
            }
        } catch (Exception $ex) {
            echo $query . ' :Cannot add ISC supervisor answer!';
            echo $ex->getMessage();
            exit;
        }
        
        return $status;
    }
    
    public static function getISC($ISCID) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        if ($PDOConn) {
            $ISCDetail = new ISCDetail;
            
            $row = $PDOConn->query("select * from ISCView where ISCID = '".$ISCID."';")->fetch(PDO::FETCH_ASSOC);
            
            // set ISC
            $ISCDetail->setISC($row['ISCID'], 
                                $row['ApplicationType'], 
                                $row['ApplicationStatus'], 
                                $row['CreatedDate'],
                                $row['Surname'],
                                $row['GivenName'],
                                $row['StudentNo'],
                                $row['Email'],
                                $row['PhoneNo'],
                                $row['ConfirmMaximumISC'],
                                $row['EnrollInPHD']
                                );
            
            // set ISC Detail
            $ISCDetail->setISCDetail($row['ISCID'], 
                                $row['CourseName'], 
                                $row['CreditPoint'], 
                                $row['ContractTitle'],
                                $row['IsAReplacement'],
                                $row['LearningObjectives'],
                                $row['ProjectOutline'],
                                $row['PreviousStudy'],
                                $row['PreviousExperience'],
                                $row['ContractLevel'],
                                $row['StudyMode'],
                                $row['CampusLocation'],
                                $row['TeachingPeriod']
                                );
            
            // set supervisor
            $su = $PDOConn->query("select * from SUPERVISOR where ISCID = '".$ISCID."';")->fetch(PDO::FETCH_ASSOC);
            $ISCDetail->addSupervisor($su['Title'], 
                                    $su['Surname'], 
                                    $su['GivenName'], 
                                    $su['Position'], 
                                    $su['School'], 
                                    $su['SupervisorEmail']);
            
            // set associate supervisor
            $as = $PDOConn->query("select * from ASSOCIATE_SUPERVISOR where ISCID = '".$ISCID."';")->fetch(PDO::FETCH_ASSOC);
            $ISCDetail->addAssociateSupervisor($as['Title'], 
                                    $as['Surname'], 
                                    $as['GivenName'], 
                                    $as['Position'], 
                                    $as['School'], 
                                    $as['AssociateEmail']);
            
            // set school dean
            $sd = $PDOConn->query("select * from SCHOOL_DEAN where ISCID = '".$ISCID."';")->fetch(PDO::FETCH_ASSOC);
            $ISCDetail->addSchoolDean( 
                                    $sd['Surname'], 
                                    $sd['GivenName'], 
                                    $sd['School'], 
                                    $sd['SchoolDeanEmail']);
            
            // set academic chair
            $ac = $PDOConn->query("select * from ACADEMIC_CHAIR where ISCID = '".$ISCID."';")->fetch(PDO::FETCH_ASSOC);
            $ISCDetail->addAcademicChair($ac['Surname'], 
                                    $ac['GivenName'], 
                                    $ac['UnitCode'], 
                                    $ac['AcademicChairEmail']);
            
            // set expected activities
            $activities = $PDOConn->query("select * from ISCExpectedActivityView where ISCID = '".$ISCID."';");
            foreach ($activities as $row) {
                $ISCDetail->addExpectedActivity($row['Name'], $row['Description']);
            }
            
            // set reading list
            $readingList = $PDOConn->query("select * from ISCReadingListView where ISCID = '".$ISCID."';");
            foreach ($readingList as $row) {
                $ISCDetail->addReadingList($row['Author'], $row['Title'], $row['PublicationDate']);
            }
            
            // set assessment components
            $components = $PDOConn->query("select * from ASSESSMENT_COMPONENT where ISCID = '".$ISCID."';");
            
            foreach ($components as $row) {
                $ISCDetail->addAssessmentCommponent($row["Description"], $row['WordLength'], $row['Percentage'], $row['DueDate'], '');
            }
            
            // set replacement unit if applicable
            $replacement = $PDOConn->query("select * from REPLACEMENT where ISCID = '".$ISCID."';")->fetch(PDO::FETCH_ASSOC);
            $ISCDetail->addReplacement($replacement["UnitCode"], $replacement["Title"], $replacement["CoreOrElective"]);
            
            // set ISC supervisor answer
            $supervisorAnswers = $PDOConn->query("select * from ISCSupervisorAnswerView where ISCID = '".$ISCID."';");
            foreach ($supervisorAnswers as $row) {
                $ISCDetail->addSupervisorAnswer($row['ItemID'], $row['YesNoAnswer'], $row['TextAnswer'], $row['Comment']);
            }
            
            $PDOConn = NULL;
        }
        
        return $ISCDetail;
    }
    
    public static function updateISC($ISC) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        $query = "call UpdateISC(:ISCID, :ApplicationType, :ApplicationStatus, :Surname, :GivenName, "
                . ":StudentNo, :Email, :PhoneNo, :ConfirmMaximumISC, :EnrollInPHD);";
        try {
            $results = $PDOConn->prepare($query);
            $results->bindParam(':ISCID', $ISC->getISCID());
            $results->bindParam(':ApplicationType', $ISC->getApplicationType());
            $results->bindParam(':ApplicationStatus', $ISC->getApplicationStatus());
            $results->bindParam(':Surname', $ISC->getSurname());
            $results->bindParam(':GivenName', $ISC->getGivenName());
            $results->bindParam(':StudentNo', $ISC->getStudentNo());
            $results->bindParam(':Email', $ISC->getEmail());
            $results->bindParam(':PhoneNo', $ISC->getPhoneNo());
            $results->bindParam(':ConfirmMaximumISC', $ISC->getConfirmMaximumISC());
            $results->bindParam(':EnrollInPHD', $ISC->getEnrollInPHD());
            $status = $results->execute();

        } catch (Exception $ex) {
            echo $query . ' :Cannot update ISC!';
            echo $ex->getMessage();
            exit;
        }
        
        return $status;
    }
    
    public static function updateISCDetail($ISCDetail) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        $query = "call UpdateISCDetails(:ISCID, :CourseName, :CreditPoint, :ContractTitle, "
                . ":IsAReplacement, :LearningObjectives, :ProjectOutline, :PreviousStudy, :PreviousExperience, "
                . ":ContractLevel, :StudyMode, :CampusLocation, :TeachingPeriod);";
        
        try {
            $results = $PDOConn->prepare($query);
            $results->bindParam(':ISCID', $ISCDetail->getISCID());
            $results->bindParam(':CourseName', $ISCDetail->getCourseName());
            $results->bindParam(':CreditPoint', strlen($ISCDetail->getCreditPoint()) == 0 ? 0 : $ISCDetail->getCreditPoint());
            $results->bindParam(':ContractTitle', $ISCDetail->getContractTitle());
            $results->bindParam(':IsAReplacement', $ISCDetail->getIsAReplacement());
            $results->bindParam(':LearningObjectives', $ISCDetail->getLearningObjectives());
            $results->bindParam(':ProjectOutline', $ISCDetail->getProjectOutline());
            $results->bindParam(':PreviousStudy', $ISCDetail->getPreviousStudy());
            $results->bindParam(':PreviousExperience', $ISCDetail->getPreviousExperience());
            $results->bindParam(':ContractLevel', $ISCDetail->getContractLevel());
            $results->bindParam(':StudyMode', $ISCDetail->getStudyMode());
            $results->bindParam(':CampusLocation', $ISCDetail->getCampusLocation());
            $results->bindParam(':TeachingPeriod', $ISCDetail->getTeachingPeriod());
            
            $status = $results->execute();
            
            // update supervisor table
            ISCDA::updateISCSupervisor($ISCDetail->getISCID(), $ISCDetail->getSupervisor());
            
            // update asociate supervisor table
            ISCDA::updateISCAssociateSupervisor($ISCDetail->getISCID(), $ISCDetail->getAssociateSupervisor());
            
            // update academic chair table if applicable
            if (strtolower($ISCDetail->getIsAReplacement() == 'yes')) {
                ISCDA::updateISCAcademicChair($ISCDetail->getISCID(), $ISCDetail->getAcademicChair());
                
                // update replacement table if applicable
                ISCDA::updateISCReplacement($ISCDetail->getISCID(), $ISCDetail->getReplacement());
            }
            
            // update school dean table
            ISCDA::updateISCSchoolDean($ISCDetail->getISCID(), $ISCDetail->getSchoolDean());
            
            // update expected activity table
            ISCDA::updateISCExpectedActivity($ISCDetail->getISCID(), $ISCDetail->getExpectedActivities());
            
            // update reading list table
            ISCDA::updateISCReadingList($ISCDetail->getISCID(), $ISCDetail->getReadingList());
            
            // update assessment component table
            ISCDA::updateISCAssessmentComponent($ISCDetail->getISCID(), $ISCDetail->getAssessmentComponents());
            
        } catch(Exeption $e) {
            echo $query . ' :Cannot update ISC details!';
            echo $ex->getMessage();
            exit;
        }
            
        return $status;    
    } // end updateISCDetail();
    
    public static function retrieveAssessmentComponents($ISCID) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        $components = array();
        try { 
            $assessmentComponents = $PDOConn->query("select * from ASSESSMENT_COMPONENT where ISCID='".$ISCID."'");

            $components = $assessmentComponents->fetchAll();
        } catch(Exeption $e) {
            echo $query . ' :Cannot get assessment components!';
            exit;
        }
        
        return $components;
    }
    
    public static function saveAssessmentComponentFileUpload($ComponentID, $fileName) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        try {
            $editedRecord = $PDOConn->exec("update ASSESSMENT_COMPONENT set FileUpload='".$fileName."' where ComponentID='" . $ComponentID . "'");
        } catch (Exception $ex) {
            echo $query . ' :Cannot update assessment component file upload!';
            echo $ex->getMessage();
            exit;
        }
        
        return $editedRecord;
    }
    
    public static function submitResult($ComponentID, $mark, $comment) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        try {
            $editedRecord = $PDOConn->exec("update ASSESSMENT_COMPONENT set Mark='".$mark."', Comment='".$comment."' where ComponentID='" . $ComponentID . "'");
        } catch (Exception $ex) {
            echo $query . ' :Cannot submit result!';
            echo $ex->getMessage();
            exit;
        }
        
        return $editedRecord;
    }
    
    private function updateISCSupervisor($ISCID, $supervisor=[]) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        $query = "call UpdateISCSupervisor(:ISCID, :Title, :Surname, :GivenName, "
                . ":Position, :School, :SupervisorEmail)";
        
        try {       
            $results = $PDOConn->prepare($query);
            $results->bindParam(':ISCID', $ISCID);
            $results->bindParam(':Title', $supervisor["title"]);
            $results->bindParam(':Surname', $supervisor["surname"]);
            $results->bindParam(':GivenName', $supervisor["givenName"]);
            $results->bindParam(':Position', $supervisor["position"]);
            $results->bindParam(':School', $supervisor["school"]);
            $results->bindParam(':SupervisorEmail', $supervisor["email"]);
            
            $results->execute();
        } catch(Exeption $e) {
            echo $query . ' :Cannot update ISC supervisor!';
            exit;
        }
    }
    
    private function updateISCAssociateSupervisor($ISCID, $associate=[]) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        $query = "call UpdateISCAssociateSupervisor(:ISCID, :Title, :Surname, :GivenName, "
                . ":Position, :School, :AssociateEmail)";
        
        try {       
            $results = $PDOConn->prepare($query);
            $results->bindParam(':ISCID', $ISCID);
            $results->bindParam(':Title', $associate["title"]);
            $results->bindParam(':Surname', $associate["surname"]);
            $results->bindParam(':GivenName', $associate["givenName"]);
            $results->bindParam(':Position', $associate["position"]);
            $results->bindParam(':School', $associate["school"]);
            $results->bindParam(':AssociateEmail', $associate["email"]);
            
            $results->execute();
        } catch(Exeption $e) {
            echo $query . ' :Cannot update ISC associate supervisor!';
            exit;
        }
    }
    
    private function updateISCSchoolDean($ISCID, $schoolDean=[]) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        $query = "call UpdateISCSchoolDean(:ISCID, :Surname, :GivenName, :School, :SchoolDeanEmail)";
        
        try {       
            $results = $PDOConn->prepare($query);
            $results->bindParam(':ISCID', $ISCID);
            $results->bindParam(':Surname', $schoolDean["surname"]);
            $results->bindParam(':GivenName', $schoolDean["givenName"]);
            $results->bindParam(':School', $schoolDean["school"]);
            $results->bindParam(':SchoolDeanEmail', $schoolDean["email"]);
            
            $results->execute();
        } catch(Exeption $e) {
            echo $query . ' :Cannot update ISC school dean!';
            exit;
        }
    }
    
    private function updateISCAcademicChair($ISCID, $academicChair=[]) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        $query = "call UpdateISCAcademicChair(:ISCID, :Surname, :GivenName, :UnitCode, :AcademicChairEmail)";
        
        try {       
            $results = $PDOConn->prepare($query);
            $results->bindParam(':ISCID', $ISCID);
            $results->bindParam(':Surname', $academicChair["surname"]);
            $results->bindParam(':GivenName', $academicChair["givenName"]);
            $results->bindParam(':UnitCode', $academicChair["unitCode"]);
            $results->bindParam(':AcademicChairEmail', $academicChair["email"]);
            
            $results->execute();
        } catch(Exeption $e) {
            echo $query . ' :Cannot update ISC academic chair!';
            exit;
        }
    }
    
    private function updateISCExpectedActivity($ISCID, $expectedActivities) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        // delete old data before adding new ones
        $PDOConn->exec("call DeleteOldISCExpectedActivity(".$ISCID.")");
        
        $query = "call UpdateISCExpectedActivity(:ISCID, :Name, :Description)";
        
        foreach ($expectedActivities as $activity) {
            try {       
                $results = $PDOConn->prepare($query);
                $results->bindParam(':ISCID', $ISCID);
                $results->bindParam(':Name', $activity["name"]);
                $results->bindParam(':Description', $activity["description"]);

                $results->execute();
            } catch(Exeption $e) {
                echo $query . ' :Cannot update ISC expected activities!';
                exit;
            }
        }
    }
    
    private function updateISCReadingList($ISCID, $list) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        // delete old data before adding new ones
        $PDOConn->exec("call DeleteOldISCReadingList(".$ISCID.")");
        
        $query = "call UpdateISCReadingList(:ISCID, :Author, :Title, :PublicationDate)";
        
        foreach ($list as $ele) {
            try {       
                $results = $PDOConn->prepare($query);
                $results->bindParam(':ISCID', $ISCID);
                $results->bindParam(':Author', $ele["author"]);
                $results->bindParam(':Title', $ele["title"]);
                $results->bindParam(':PublicationDate', $ele["publicationDate"]);

                $results->execute();
            } catch(Exeption $e) {
                echo $query . ' :Cannot update ISC reading list!';
                exit;
            }
        }
    }
    
    private function updateISCReplacement($ISCID, $replacement) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        // delete old data before adding new ones
        $PDOConn->exec("call DeleteOldISCReplacement(".$ISCID.")");
        
        $query = "call UpdateISCReplacement(:ISCID, :UnitCode, :Title, :CoreOrElective)";
        
        try {       
            $results = $PDOConn->prepare($query);
            $results->bindParam(':ISCID', $ISCID);
            $results->bindParam(':UnitCode', $replacement["unitCode"]);
            $results->bindParam(':Title', $replacement["title"]);
            $results->bindParam(':CoreOrElective', $replacement["coreOrElective"]);
            
            $results->execute();
        } catch(Exeption $e) {
            echo $query . ' :Cannot update ISC academic chair!';
            exit;
        }
    }
    
    private function updateISCAssessmentComponent($ISCID, $assessmentComponents=[]) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        // delete old data before adding new ones
        $PDOConn->exec("call DeleteOldISCAssessmentComponent(".$ISCID.")");
        
        $query = "call UpdateISCAssessmentComponent(:ISCID, :Description, :WordLength, :Percentage, :DueDate)";
        
        foreach ($assessmentComponents as $component) {
            try {       
                $results = $PDOConn->prepare($query);
                $results->bindParam(':ISCID', $ISCID);
                $results->bindParam(':Description', $component["description"]);
                $results->bindParam(':WordLength', $component["wordLength"]);
                $results->bindParam(':Percentage', $component["percentage"]);
                $results->bindParam(':DueDate', $component["dueDate"]);

                $results->execute();
            } catch(Exeption $e) {
                echo $query . ' :Cannot update ISC assessment components!';
                exit;
            }
        }
    }

} // end ISCDA class

