<?php

/* 
    Murdoch University - ICT333 - F03 - ISCon - TSA14

    Author: MyVi14
    Date: 1 November 2014
    Purpose: Default controller in case no specific controller is requested.
             Served as the point to process the first site a user sees
 */
class Home extends Controller {
    
    /*
     * Return index page which is the home page
     */
    public function index() {
        $this->view('home/index', null);
    }
    
    /*
     * Return student home page
     */
    public function student($name = '') {
        require_once 'ISCController.php';
        
        $iscController = new ISCController;
        
        $this->view('home/studentHome', $iscController->getISCList());      
    }
    
    /*
     * Return supervisor home page
     */
    public function supervisor($name = '') {
        require_once 'ISCController.php';
        
        $iscController = new ISCController;
 
        $this->view('home/supervisorHome', $iscController->getISCList());
    }
    
    /*
     * Return academic chair home page
     */
    public function academicChair($name = '') {
        require_once 'ISCController.php';
        
        $iscController = new ISCController;
        
        $this->view('home/academicChairHome', $iscController->getISCList());
    }
    
    /*
     * Return school dean home page
     */
    public function schoolDean($name = '') {
        require_once 'ISCController.php';
        
        $iscController = new ISCController;
        
        $this->view('home/schoolDeanHome', $iscController->getISCList());
    }
    
    public function authorize($user = []) {
        // TODO: connect to Murdoch System to authorize user
    }
} // end class Home