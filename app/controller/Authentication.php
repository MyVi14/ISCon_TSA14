<?php

class Authentication {
    public function student() {
        
    }
    
    public function academicChair() {
        
    }
    
    public function schoolDean() {
        
    }
    
    public function supervisor() {
        
    }
    
    /*
     * This function sends a post request with conten in JSON to a specified URL
     * Returned data must be in JSON format and will be decoded in PHP array
     * 
     * @param       $url            URl to which the request is sent
     * @param       $postContent    Post content in JSON format
     * 
     * $return      $responseData   returned data in array and decoded from JSON content
     */
    private function generateRequest($url, $postContent) {
        // Create the context for the request
        $context = stream_context_create(array(
            'http' => array(
                // http://www.php.net/manual/en/context.http.php
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n",
                'content' => json_encode($postContent)
            )
        ));

        // Send the request
        $response = file_get_contents($url, FALSE, $context);

        // Check for errors
        if($response === FALSE){
            die('Error');
        }

        // Decode the response
        $responseData = json_decode($response, TRUE);

        return $responseData;
    }
} // end Authentication class

