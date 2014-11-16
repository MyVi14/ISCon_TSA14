<?php

require_once 'Connection.php';
/* This class is just for test!
   Murdoch University - ICT333 - F03 - ISCon - TSA14

   Author: MyVi14
   Date: 1 September 2014
   Purpose: Connect to a database
*/
class TeamMemberDA {
    
    public static function retrieveTeamMemberList() {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        $members = array();
        
        if ($PDOConn) {
            $rows = $PDOConn->query('SELECT * from TeamMember');
        
            foreach ($rows as $row) {
                $member = TeamMember::newInstance($row['MemberID'], 
                                            $row['FullName'], 
                                            $row['StudentNo'], 
                                            $row['Email'],
                                            $row['PhoneNo']);
                $members[] = $member;
            }
            //$json = json_encode($members);
            //$decodedJson = json_decode($json);
            
            //var_dump( $decodedJson);
            
            $PDOConn = NULL;
        }
        
        return $members;
    }
    
    public static function retrieveTeamMemberInfo($memberID) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        $members = NULL;
        $query = "SELECT * from TeamMember where MemberID = :memberID";
        
        if ($PDOConn) {
            $statement = $PDOConn->prepare($query);
            //$statement->bindParam(":memberID", $memberID);
            $statement->execute(array(":memberID" => $memberID));
            
            $row = $statement->fetch();
            
            //foreach ($rows as $row) {
                $member = TeamMember::newInstance($row['MemberID'], 
                                            $row['FullName'], 
                                            $row['StudentNo'], 
                                            $row['Email'],
                                            $row['PhoneNo']);
                $members[] = $member;
            //}
        }
        
        return $members[0];
    }
    
    public static function createNewMember($newMember) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        $query = "insert into TeamMember(FullName, StudentNo, Email, PhoneNo) "
                . "values('".$newMember->getFullName()."','".$newMember->getStudentNo()."','".$newMember->getEmail()."','".$newMember->getPhoneNo()."')";
        
        $insertedRecord = 0;
        
        try {
            $insertedRecord = $PDOConn->exec($query);
            
        } catch (PDOException $ex) {
            echo $query . '<br />' . $e->getMessage();
        }
        
        return $insertedRecord;
    }
    
    public static function deleteTeamMember($memberID) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        $query = "Delete from TeamMember where MemberID = :memberID";
        
        $results = $PDOConn->prepare($query);
        $results->bindParam(":memberID", $memberID);
        
        $deletedRecord = 0;
        
        try {
            //$deletedRecord = $PDOConn->exec($query);
            $deletedRecord = $results->execute();
            
        } catch (PDOException $ex) {
            echo $query . '\n' . $e->getMessage();
        }
        
        return $deletedRecord;
    }
    
    public static function saveTeamMember($member) {
        // connect to database
        $PDOConn = Connection::getConnection();
        
        $query = "update TeamMember "
                . "set FullName = '".$member->getFullName()."',"
                . "StudentNo = '".$member->getStudentNo()."',"
                . "Email = '".$member->getEmail()."',"
                . "PhoneNo = '".$member->getPhoneNo()."'"
                . "where MemberID = '".$member->getMemberID()."'";
        
        $editedRecord = 0;
        
        try {
            $editedRecord = $PDOConn->exec($query);
            
        } catch (PDOException $ex) {
            echo $query . '\n' . $ex->getMessage();
        }
        
        return $editedRecord;
    }
    
} // end class TeamMemberDA
