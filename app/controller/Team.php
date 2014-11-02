<?php

/* This class is just  for Test!
    Murdoch University - ICT333 - F03 - ISCon - TSA14

    Author: MyVi14
    Date: 1 November 2014
    Purpose: Controller for processing business logic for Team Member
 */
class Team extends Controller {
    public function getTeamMemberList() {
        $member = $this->model('TeamMember');
        
        // get team member information
        $members = $member::getTeamMemberList();
        
//        $amember = TeamMember::newInstance(123, "asfd", "asdf", "asf", "asdf");
//        echo $amember;
        
        $this->view('home/teamMembers', $members);
    }
    
    public function getTeamMember($memberID = '') {
        $member = $this->model('TeamMember');
        
        $member = $member::getTeamMember($memberID);
        
        $this->view('home/editTeamMember', $member);
    }
    
    public function addTeamMember($method='', $newMemberArr = []) {
        require_once '../app/model/TeamMember.php';
        
        if (strcmp($method, "form") == 0) {
            $result = TeamMember::createNewTeamMember($newMemberArr["fullName"], 
                                                $newMemberArr["studentNo"], 
                                                $newMemberArr["email"], 
                                                $newMemberArr["phoneNo"]);
            
            // notify view
            $this->view('home/addTeamMember', ["result" => $result]);
            
        } if (strcmp($method, "json") == 0) {
            // get json string and convert to TeamMember object
            $json = json_decode(file_get_contents('php://input'),true);
            
            if ($json != NULL) {
                echo 'Received json string';
            }
            // TOTO: create object from $json
        } else {
            $this->view('home/addTeamMember', NULL);
        }
    }
    
    public function saveTeamMember($memberID = '', $memberInfo = []) {
        require_once '../app/model/TeamMember.php';
      
        if ($memberID != null && count($memberInfo) != 0) {
            
            $status = TeamMember::saveTeamMember($memberID, 
                                        $memberInfo["fullName"], 
                                        $memberInfo["studentNo"], 
                                        $memberInfo["email"], 
                                        $memberInfo["phoneNo"]);
            
            header('Location: ' . $this->getURL() . 'public/team/getTeamMemberList');
            
            //echo $status . " is edited";
        }
        
    }
    
    public function deleteTeamMember($memberID) {
        if ($memberID != null) {
            $member = $this->model('TeamMember');

            $status = $member::deleteTeamMember($memberID);
            
            header('Location: ' . $this->getURL() . 'public/team/getTeamMemberList');
            //echo $status . " record(s) is deleted";
        }
    }
}

