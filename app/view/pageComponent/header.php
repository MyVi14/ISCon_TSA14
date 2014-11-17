<?PHP
    $urlPrefix = $this->getURL();
?>
<!DOCTYPE html> 

<html xmlns:lpaf="urm:lpaf" lang="en">

<!-- [ START HEAD ]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title> <?PHP echo $title; ?> </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://my.murdoch.edu.au/resource/style/bootstrap.css" type="text/css">
<link href="https://static.murdoch.edu.au/fonts/roboto/roboto_condensed_macroman/stylesheet.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://static.murdoch.edu.au/general/fonts/adelle/css/adelle.css" type="text/css">
<link rel="stylesheet" href="https://static.murdoch.edu.au/general/fonts/font-awesome/4.1.0/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="https://my.murdoch.edu.au/resource/style/style.3.0.css">   <!--[if lt IE 9]>
<script src="//static.murdoch.edu.au/irespond/js/3.1.0/html5shiv.js"></script><script src="//static.murdoch.edu.au/irespond/js/3.1.0/respond.min.js"></script>
   <![endif]-->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="//static.murdoch.edu.au/irespond/images/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="//static.murdoch.edu.au/irespond/images/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="//static.murdoch.edu.au/irespond/images/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="//static.murdoch.edu.au/irespond/images/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="//static.murdoch.edu.au/wouext/images/favicon.gif/">

<script async="" defer="" type="text/javascript" src="https://www.rnengage.com/api/1/javascript/acs.js"></script>
<script async="" defer="" type="text/javascript" src="https://www.rnengage.com/api/e/ca8757/e.js"></script>
<script async="" src="http://www.google-analytics.com/analytics.js"></script>
<script type="text/javascript" src="https://static.murdoch.edu.au/lib/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://static.murdoch.edu.au/lib/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://my.murdoch.edu.au/resource/lib/jquery.lpaf.js"></script>
<script id="yui__dyn_0" type="text/javascript" charset="utf-8" src="https://myanswers.widget.custhelp.com/ci/ws/get/w/3/co/%5B%7B%22div_id%22%3A%22myanswers-faqs%22%2C%22instance_id%22%3A%22skw_0%22%2C%22module%22%3A%22KnowledgeSyndication%22%2C%22target%22%3A%22_blank%22%2C%22type%22%3A3%7D%5D/https_request/1"></script>

<link id="yui__dyn_1" type="text/css" charset="utf-8" rel="stylesheet" href="https://myanswers.widget.custhelp.com/euf/assets/css/syndicated_widgets/standard/KnowledgeSyndication.css">

<!--[ Additional stype ] -->

<!-- OSX Style CSS files -->
<link type='text/css' href='<?PHP echo BASE_URL . "public/css/osx.css" ?>' rel='stylesheet' media='screen' />
<style>
       
        .back-to-top {
            position: fixed;
            bottom: 2em;
            right: 0px;
            text-decoration: none;
            color: #000000;
            background-color: rgba(235, 235, 235, 0.80);
            font-size: 12px;
            padding: 1em;
            display: none;
        }

        .back-to-top:hover {	
            background-color: rgba(135, 135, 135, 0.50);
        }
</style>
</head>
<!--[ END HEADER ] -->

<body>
<!-- [ BEGIN CONTENT AREA ]--> 
<div id="_lpaf_portlet_2" class="portlet portlet-plain">
    <script>
         var gaid = 'UA-55452205-1';
         
         (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
         (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
         m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
         })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

         ga('create', gaid, 'murdoch.edu.au');
         ga('send', 'pageview');
    </script>
</div>

<a class="sr-only" href="#content">Skip navigation</a>

<div class="top-floater hidden-xs"></div>


<div id="wrapper">
<div id="_lpaf_portlet_3" class="portlet portlet-plain">
    <div class="portlet-toolbar"><a class="tool loading"><span class="fa fa-spin fa-spinner"></span></a></div>
    <header class="hidden-xs"><div id="header" class="hidden-xs">
    <div id="global-bar">
    <div id="header-nav"><ul>
    <li><a href="<?PHP echo $urlPrefix . 'public/home/index'; ?>">Home</a></li>
    <li><a href="<?PHP echo $urlPrefix . 'public/home/student'; ?>">Student</a></li>
    <li><a href="<?PHP echo $urlPrefix . 'public/home/supervisor'; ?>">Supervisor</a></li>
    <li><a href="<?PHP echo $urlPrefix . 'public/home/academicChair'; ?>">Academic Chair</a></li>
    <li><a href="<?PHP echo $urlPrefix . 'public/home/schoolDean'; ?>">School Dean</a></li>
    <li><a href="<?PHP echo $urlPrefix . 'public/Team/getTeamMemberList'; ?>">Team Member</a></li>
    </ul></div>
    <div id="header-search"><form enctype="application/x-www-form-urlencoded" method="get" action="http://search.murdoch.edu.au">
    <label for="q">Enter search term</label><input type="text" value="" autocomplete="off" title="enter search term" id="q" name="q"><input type="submit" value="Search" class="btn btn-default btn-xs"><input type="hidden" value="internal" name="searchSite">
    </form></div>
    </div>
    <div id="header-logo"><a title="Murdoch University Home Page" href="http://www.murdoch.edu.au/">
                Murdoch University Home Page

             </a></div>
    </div></header>
</div>
<!--[ END CONTENT AREA ] -->
