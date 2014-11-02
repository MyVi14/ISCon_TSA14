<?php

    /* 
       Murdoch University - ICT333 - F03 - ISCon - TSA14

       Author: MyVi14
       Date: 1 November 2014
       Purpose: Initialize global variables which other classes will use
   */
// change folder name here
$name = 'ISCon';

$root = '/'.$name.'/';

$rootFolderName = $_SERVER['DOCUMENT_ROOT'] . $root;

// find server url
$urlPrefix = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

$urlPrefix .= $root;

require_once __DIR__ . '/core/App.php';
require_once __DIR__ . '/core/Controller.php';

