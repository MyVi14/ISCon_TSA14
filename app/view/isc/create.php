<?PHP
    $title = "Create New ISC Page";
    include_once $studentHeader;
?>

<?PHP

if ( $data == null ) {
    echo '<form action="'.BASE_URL . 'public/ISCController/create?section=A'.'" method="POST" role="form" class="form-horizontal">';
    include_once dirname(__FILE__). '/../iscDetail/personalDetails.php';
    echo '<hr />';
    echo '<div class="form-group">';
    echo '<div class="col-sm-10">';
        echo '<input type="submit" value="Submit" class="btn btn-default" />';
        echo '&nbsp;&nbsp;';
        echo '<input type="reset" value="Reset" class="btn btn-default" />';
    echo '</div>';
    echo '</div>';
    echo '</form>';
} else if ($_GET['section'] == 'A'){
    // create new ISC and get new ID
    require_once ROOT_PATH . 'app/controller/ISCController.php';
    $iscController = new ISCController;
    $newISCID = $iscController->createISC($data);
    
    // show ISC details
    echo '<form action="'.BASE_URL . 'public/ISCController/create?section=B'.'" method="POST" role="form" class="form-horizontal">';
    echo "<h2> Fill in data for ISCID: $newISCID </h2>";
    include_once dirname(__FILE__). '/../iscDetail/iscDetails.php';
        echo '<input type="hidden" value="'.$newISCID.'" name="ISCID" />';
    echo '<hr />';
    echo '<div class="form-group">';
    echo '<div class="col-sm-10">';
        echo '<input type="submit" value="Submit" class="btn btn-default" />';
        echo '&nbsp;&nbsp;';
        echo '<input type="reset" value="Reset" class="btn btn-default" />';
    echo '</div>';
    echo '</div>';
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
    
    echo '<form action="'.BASE_URL . 'public/ISCController/create?section=submit'.'" method="POST" role="form" class="form-horizontal" id="iscSubmitForm">';
    // show the submit page including showing all details
    echo "<h2> ISCID: $ISCID </h2>";
    include_once dirname(__FILE__). '/../iscDetail/personalDetails.php';
    include_once dirname(__FILE__). '/../iscDetail/iscDetails.php';
        echo '<input type="hidden" value="'.$ISCID.'" name="ISCID" />';
        echo '<input type="hidden" value="Processing" name="applicationStatus" />'; // hard code application status
    echo '<hr />';
    echo '<div class="form-group">';
    echo '<div class="col-sm-10">';
        echo '<input type="submit" value="Submit" class="btn btn-default" />';
        echo '&nbsp;&nbsp;';
        echo '<button name="btnUpdateISC" class="btn btn-default" data-url="'.BASE_URL.'public/ISCController/update/'.$ISCID.'"> Update </button>';
        echo '&nbsp;&nbsp;';
        echo '<input type="reset" value="Reset" class="btn btn-default" />';
    echo '</div>';
    echo '</div>';
    echo '</form>';
 ?>
<script>
    $(document).ready(function(e){
        // click update button
        $('[name="btnUpdateISC"]').click(function(e){         
            
            // change status to new
            $('[name="applicationStatus"]').attr("value", "New");
            
            var url = $(this).attr("data-url");

            // set new action attribute
            $("#iscSubmitForm").attr("action", url);
        });
    });
</script>
<?PHP
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
        echo '<h3>Thank your for your participation!</h3>';
    } else {
        echo 'Some error. You can start again';
    }
}   

?>

<?PHP
    include($footerLink);
?>