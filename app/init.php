<?php

    /* 
       Murdoch University - ICT333 - F03 - ISCon - TSA14

       Author: MyVi14
       Date: 1 November 2014
       Purpose: Initialize global variables which other classes will use
   */


$rootFolderName = $_SERVER['DOCUMENT_ROOT'] . '/MVCSimple/';

// find server url
$urlPrefix = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$root = '/MVCSimple/';
$urlPrefix .= '' . $root;

require_once __DIR__ . '/core/App.php';
require_once __DIR__ . '/core/Controller.php';


