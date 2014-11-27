<?php
    include_once $headerLink;
    
    $navTitle = 'ISC Supervisor Portal';
    $barArr = array(
                array("value" => "Home", "href" => BASE_URL . "public/Home/supervisor")
        );
    
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
          <a class="navbar-brand" href="#"> <?PHP echo $navTitle; ?></a>
      </div>
      <div>
        <ul class="nav navbar-nav">
          <?PHP 
              foreach ($barArr as $item) {
                  echo '<li><a href="'.$item['href'].'"> '.$item['value'].' </a></li>';
              }
          ?>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
        </ul>
      </div>
    </div>
  </nav>

