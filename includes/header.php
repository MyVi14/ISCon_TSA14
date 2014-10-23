<?php

// find server url
$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

$rootFolderName = '/ISCon/';

$url .= '' . $rootFolderName;
?>

<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Transitional//EN" “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 

<html xmlns="http://www.w3.org/1999/xhtml">

<!-- [ HEADER ] -->
<head>

	<!-- 
	   Murdoch University - ICT333 - F03 - ISCon - TSA14
	
	   Author: Tony
	   Date: 22 September 2014
	   Purpose: Represent the common header of website
   -->

	<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
	<title>Murdoch University in Perth, Australia</title>
	<link rel="shortcut icon" href="http://www.murdoch.edu.au/_image/favicon.gif/" />
    <link rel="icon" href="http://www.murdoch.edu.au/_image/favicon.gif/" />    
	<link media="all" href="http://www.murdoch.edu.au/_stylesheet/External/common.css/" rel="stylesheet" type="text/css" />
	<link media="all" href="http://www.murdoch.edu.au/_stylesheet/External/promo.css/" rel="stylesheet" type="text/css" />
	<link media="all" href="http://www.murdoch.edu.au/_stylesheet/External/layout.css/" rel="stylesheet" type="text/css" />
	<link media="all" href="http://www.murdoch.edu.au/_stylesheet/External/microsite.css/" rel="stylesheet" type="text/css" />

	<script xml:space="preserve" type="text/javascript" src="http://www.murdoch.edu.au/_javascript/jquery.js/"> </script>
	<script xml:space="preserve" type="text/javascript" src="http://www.murdoch.edu.au/_javascript/common.js/"> </script>
	<meta content="Murdoch University in Perth, Australia" name="title"/>
</head>
<!--[ END HEADER ] -->

<body id="homepage" class="page"> 

<div id="body">

	<div id="header">
	 <div id="murdoch_header_logo" onclick="document.location.href='http://www.murdoch.edu.au'"></div>	
	</div>
	
<!-- [ MENU NAVIGATION ] -->
	<div id="sub_navigation">
		<ul>
			<li><a class="home" href="<?PHP echo $url ?>" shape="rect">Home</a></li> 
			<li><a href="<?PHP echo $url . 'view/studentHome.php' ?>" shape="rect">For Student</a></li>
			<li><a href="#" shape="rect">For Supervisor</a></li>
			<li><a href="#" shape="rect">For Academic Chair</a></li>
			<li><a href="#" shape="rect">For School Dean</a></li>
			<li><a href="<?PHP echo $url . 'view/teamMembers.php' ?>" shape="rect">Team Member</a></li>	
		</ul>
	</div>
	
	<div id="breadcrumb">Main Murdoch site : Home
		
	</div>

<!-- [ BEGIN CONTENT AREA (WHITE CANVAS SECTION) ]--> 
<div id="content">

<!-- [ HEADER BANNER ] -->
	<div id="flash">
		<img src="<?PHP echo $url . 'images/Education-Banner.jpg' ?>" alt="header banner" width="960" height="240" /> 
	</div>
<!-- [ END HEADER BANNER ] -->