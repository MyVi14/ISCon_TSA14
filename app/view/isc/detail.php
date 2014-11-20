<?PHP
    $title = "ISC Detail Page";
    include($headerLink);
?>
<?PHP
    // set ISCID, taken from data array argument
    $ISCID = $data["ISCID"];
    
    // set who is viewing it
    $who = $data["who"];
    
    require_once ROOT_PATH . 'app/controller/ISCController.php';
    $iscController = new ISCController;
    $ISCObj = $iscController->getISC($ISCID);
    
    echo "<h2> ISCID: $ISCID </h2>";
    echo '<form role="form" class="form-horizontal" >';
    include_once dirname(__FILE__). '/../iscDetail/personalDetails.php';
    include_once dirname(__FILE__). '/../iscDetail/iscDetails.php';
    
    if($who != 'student')
        include_once dirname(__FILE__). '/../iscDetail/supervisorAnswer.php';
    echo '</form>';
?>

<a href="#" class="back-to-top">Back to Top</a>

<script>            
    jQuery(document).ready(function() {
            var offset = 220;
            var duration = 500;
            jQuery(window).scroll(function() {
                    if (jQuery(this).scrollTop() > offset) {
                            jQuery('.back-to-top').fadeIn(duration);
                    } else {
                            jQuery('.back-to-top').fadeOut(duration);
                    }
            });

            jQuery('.back-to-top').click(function(event) {
                    event.preventDefault();
                    jQuery('html, body').animate({scrollTop: 0}, duration);
                    return false;
            })
    });
</script>
                
<?PHP
    include($footerLink);
?>