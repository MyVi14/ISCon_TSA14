<?php

/* 
    Murdoch University - ICT333 - F03 - ISCon - TSA14

    Author: MyVi14
    Date: 1 November 2014
    Purpose: Controller for processing business logic for Indenpendent Study Contract
 */
class ISC extends Controller {
    
    public function create($newISC = []) {
        
    }
    
    public function get($ISCID = '') {
        $this->view('isc/detail', null);
    }
    
    public function approve($ISCID = '', $status = '', $who = '') {
        
    }
    
    public function submitComponents($ISCID = '', $components = []) {
        
    }
    
}

