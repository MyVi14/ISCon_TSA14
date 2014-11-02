<?php

include(dirname(__FILE__) . '/../da/TeamMemberDA.php');

/* This is just for test!
   Murdoch University - ICT333 - F03 - ISCon - TSA14

   Author: MyVi14
   Date: 1 September 2014
   Purpose: Representing a team member
*/
class TeamMember implements JsonSerializable {
    private $memberID;
    private $fullName;
    private $studentNo;
    private $email;
    private $phoneNo;
    
    function __construct() {
        $this->memberID = -1;
        $this->fullName = 'Unknown';
        $this->studentNo = 'Unknown';
        $this->email = 'Unknown';
        $this->phoneNo = 'Unknown';
    }

    public static function getTeamMemberList() {
        return TeamMemberDA::retrieveTeamMemberList();
    }
    
    public static function getTeamMember($memberID) {
        return TeamMemberDA::retrieveTeamMemberInfo($memberID);
    }
    
    public static function createNewTeamMember($fullName, $studentNo, $email, $phoneNo) {
        return TeamMemberDA::createNewMember(TeamMember::newInstance(null, $fullName, $studentNo, $email, $phoneNo));
    }
    
    public static function saveTeamMember($memberID, $fullName, $studentNo, $email, $phoneNo) {
        
        $editedMember = TeamMember::newInstance($memberID, $fullName, $studentNo, $email, $phoneNo);
        
        return TeamMemberDA::saveTeamMember($editedMember);
    }
    
    public static function deleteTeamMember($memberID) {
        return TeamMemberDA::deleteTeamMember($memberID);
    }
    
    public static function newInstance($newMemberID, $newFullName, $newStudentNo, $newEmail, $newPhoneNo) {
        $newInstance = new TeamMember();
        
        $newInstance->setMemberID($newMemberID);
        $newInstance->setFullName($newFullName);
        $newInstance->setStudentNo($newStudentNo);
        $newInstance->setEmail($newEmail);
        $newInstance->setPhoneNo($newPhoneNo);
        
        return $newInstance;
    }
    
    public function __toString() {
        return "MemberID: " . $this->getMemberID() . 
                "FullName: " . $this->getFullName() .
                "StudentNo: " . $this->getStudentNo() .
                "Email: " . $this->getEmail() . 
                "PhoneNo: " . $this->getPhoneNo();
    }
    
    public function getMemberID() {
        return $this->memberID;
    }

    function getFullName() {
        return $this->fullName;
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

    function setMemberID($memberID) {
        $this->memberID = $memberID;
    }

    function setFullName($fullName) {
        $this->fullName = $fullName;
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

    public function jsonSerialize() {
        return [
          'memberID' => $this->getMemberID(),
          'fullName' => $this->getFullName(),
          'studentNo' => $this->getStudentNo(),
          'email' => $this->getEmail(),
          'phoneNo' => $this->getPhoneNo()
        ];
    }

} // end TeamMeber

