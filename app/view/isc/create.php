<?PHP
    include($headerLink);
?>

<?PHP

if ( $data == null ) {
    echo '<form action="'.BASE_URL . 'public/ISCController/create?section=A'.'" method="POST" role="form">';
    include_once dirname(__FILE__). '/../iscDetail/personalDetails.php';
        echo '<input type="submit" value="Submit" />';
        echo '<input type="reset" value="Reset" />';
    echo '</form>';
} else if ($_GET['section'] == 'A'){
    // create new ISC and get new ID
    require_once ROOT_PATH . 'app/controller/ISCController.php';
    $iscController = new ISCController;
    $newISCID = $iscController->createISC($data);
    
    // show ISC details
    echo '<form action="'.BASE_URL . 'public/ISCController/create?section=B'.'" method="POST" role="form">';
    include_once dirname(__FILE__). '/../iscDetail/iscDetails.php';
        echo '<input type="hidden" value="'.$newISCID.'" name="ISCID" />';
        echo '<input type="submit" value="Submit" />';
        echo '<input type="reset" value="Reset" />';
    echo '</form>';
} else if ($_GET['section'] == 'B') {
    // process ISC detail
    // create new ISC and get new ID
    require_once ROOT_PATH . 'app/controller/ISCController.php';
    $iscController = new ISCController;
    
    // get ISCID and unset it
    $ISCID = $data["ISCID"];
    unset($data["ISCID"]);
    
    // unset all button names
    unset($data["btnSubmitISC"]);
    
    if ($data != null) {
        // udpate ISC detail
        $iscController->updateISCDetail($ISCID, $data);
    }
    
    // get ISC object
    $ISCObj = $iscController->getISC($ISCID);
    
    echo '<form action="'.BASE_URL . 'public/ISCController/create?section=submit'.'" method="POST" role="form">';
    // show the submit page including showing all details
    include_once dirname(__FILE__). '/../iscDetail/personalDetails.php';
    include_once dirname(__FILE__). '/../iscDetail/iscDetails.php';
        echo '<input type="hidden" value="'.$ISCID.'" name="ISCID" />';
        echo '<input type="hidden" value="processing" name="applicationStatus" />'; // hard code application status
        echo '<input type="submit" value="Submit" />';
        echo '<input type="reset" value="Reset" />';
    echo '</form>';
    
} else if ($_GET['section'] == 'submit') {
    // create new ISC and get new ID
    require_once ROOT_PATH . 'app/controller/ISCController.php';
    $iscController = new ISCController;
    
    // get ISCID and unset it
    $ISCID = $data["ISCID"];
    unset($data["ISCID"]);
    
    // update ISC
    $iscController->updateISC($ISCID, $data);
    
    // udpate ISC detail
    $status = $iscController->updateISCDetail($ISCID, $data);
    
    if ($status == 1) {
        echo '<h3> You have successfully submitted one ISC</h3>';
        echo '<h3>Thank your for your cooperation!</h3>';
    } else {
        echo 'Some error. You can start again';
    }
}   

?>

<?PHP
    include($footerLink);
?>