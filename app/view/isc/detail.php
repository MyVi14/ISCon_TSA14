<?PHP
    include($headerLink);
?>
<?PHP
    // set ISCID, taken from data array argument
    $ISCID = $data["ISCID"];
    
    require_once ROOT_PATH . 'app/controller/ISCController.php';
    $iscController = new ISCController;
    $ISCObj = $iscController->getISC($ISCID);
    
    include_once dirname(__FILE__). '/../iscDetail/personalDetails.php';
    include_once dirname(__FILE__). '/../iscDetail/iscDetails.php';
?>
<?PHP
    include($footerLink);
?>