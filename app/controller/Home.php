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
        //$user = $this->model('User');
        
        //$user->name = $name;
        
        $this->view('home/studentHome', null);
    }
    
    /*
     * Return supervisor home page
     */
    public function supervisor($name = '') {
        $this->view('home/supervisorHome', null);
    }
    
    /*
     * Return academic chair home page
     */
    public function academicChair($name = '') {
        $this->view('home/academicChairHome', null);
    }
    
    /*
     * Return school dean home page
     */
    public function schoolDean($name = '') {
        $this->view('home/schoolDeanHome', null);
    }
    
    public function authorize($user = []) {
        // TODO: connect to Murdoch System to authorize user
    }
} // end class Home