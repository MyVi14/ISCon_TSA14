<?PHP
    include($headerLink);
    
    $ISCID = $data["ISCID"];
    $who = $data["who"];
?>

<?php
    if ($who == "supervisor") {
        echo '<h3> Fill in data for ISCID: <?PHP echo $ISCID; ?></h3>';
        echo '<form action="'.BASE_URL.'public/SupervisorController/submitAnswers/'.$ISCID.'" method="POST" >';
        include_once ROOT_PATH. 'app/view/iscDetail/supervisorAnswer.php';
        
        echo '<label> Are you willing to supervise this ISC? </label>';
        echo '<p>';
        echo '<button type="btnAgree"> Agree </button>';
        echo '<button type="btnNotAgree"> Not Agree </button>';
        echo '</p>';
        echo '</form>';
    }
?>

<?PHP
    include($footerLink);
?>