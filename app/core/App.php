<?php

/* 
    Murdoch University - ICT333 - F03 - ISCon - TSA14

    Author: MyVi14
    Date: 1 November 2014
    Purpose: Parse GET URL, get POST content and validate input data from users.
             Serve as the point to call functions from controllers.
*/
class App{
        // controller name that will be initialized and called
    protected $controller = 'Home';
        // method of the controller that will be called
    protected $method = 'index';
        // parameters can that can passed to the method
    protected $params = [];
    
    // default contructor will be called when users request a URL
    public function __construct() {
        $url = $this->parseURL();
        
        /* Get controller class */
        // if the file does not exist, call default controller
        if (file_exists('../app/controller/'. $url[0] .'.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        
        require_once '../app/controller/'.$this->controller.'.php';
        
        $this->controller = new $this->controller;
        
        /* Get method name */
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];           
                unset($url[1]);
            }
        }
        
        /* Get parameters if any */
        $this->params = $url ? array_values($url) : [];
        
        // append POST data to param array
        $postContent = $this->getPOSTContent();
        if ( $postContent != NULL ) {
            $this->params[] = $postContent;
            unset($_POST);
        }
        
        //print_r($this->params);
        
        // call method of controller with params passed in
        call_user_func_array([$this->controller, $this->method], $this->params);
        
    } // end contructor
    
    /**
     * Get URL string and sanitize it
     * 
     * @return processed URL
     */
    public function parseURL(){
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
    
    /*
     * Get POST content and sanitize it
     * 
     * @return POST content
     */
    public function getPOSTContent() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // TODO: sanitize input
            return $_POST;
        } else {
            return null;
        }
    }
} // end class App

