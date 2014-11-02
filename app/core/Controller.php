<?php
/* 
    Murdoch University - ICT333 - F03 - ISCon - TSA14

    Author: MyVi14
    Date: 1 November 2014
    Purpose: Provide common functions which a controller uses
*/
class Controller
{
    /**
     * Create and return an object with $model type
     * 
     * @param type $model needs creating
     * @return \model a new object
     */
    public function model($model) {
        require_once __DIR__ . '/../model/'.$model.'.php';
        
        return new $model();
    }
    
    /**
     * Return user with view requested
     * 
     * @global type $rootFolderName is set from init.php
     * @param type $view to show user
     * @param type $data that $view needs
     */
    
    public function view($view, $data = []) {
        global $rootFolderName;
        
        $headerLink = $rootFolderName . 'app/view/pageComponent/header.php';
        $footerLink = $rootFolderName . 'app/view/pageComponent/footer.php';
        
        require_once __DIR__ . '/../view/' . $view . '.php';
    }
    
    protected function getURL() {
        global $urlPrefix;
        
        return $urlPrefix;
    }
} // end class Controller
