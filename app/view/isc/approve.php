<?PHP
    $title = "Approve ISC Page";
    include($supervisorHeader);
    
    $ISCID = $data["ISCID"];
    $who = $data["who"];
?>

<?php
    if ($who == "supervisor") {
        // get data for ISCObject
        require_once ROOT_PATH . 'app/controller/ISCController.php';
        $iscController = new ISCController;
        $ISCObj = $iscController->getISC($ISCID);
        
        echo '<form action="'.BASE_URL.'public/SupervisorController/" method="POST" id="supervisorApproveForm" role="form" class="form-horizontal" >';
        echo "<h2> Fill in data for ISCID: $ISCID </h2>";
        include_once ROOT_PATH. 'app/view/iscDetail/supervisorAnswer.php';
        
        echo '<hr />';
        echo '<h2> Are you willing to supervise this ISC? </h2>';
        echo '<div class="form-group">';
        echo '<div class="col-sm-10">';
            echo '<button data-iscid="'.$ISCID.'" name="btnSupervisorApprove" class="btn btn-default"> Agree </button>';
            echo '&nbsp;&nbsp;';
            echo '<button data-iscid="'.$ISCID.'" name="btnSupervisorUpdate" class="btn btn-default"> Update </button>';
            echo '&nbsp;&nbsp;';
            echo '<button data-iscid="'.$ISCID.'" name="btnSupervisorDisapprove" class="btn btn-default"> Not Agree </button>';
        echo '</div>';
        echo '</div>';
        echo '</form>';
    }
?>

<?PHP
    include($footerLink);
?>

<script>
        $(document).ready(function(){
            $('[name="btnSupervisorApprove"]').click(function(e){         
                if (confirm("Are you sure to approve this ISC?") == true) {
                    var url = $("#supervisorApproveForm").attr("action");
                    url += "submitAnswers/";
                    url += $(this).attr("data-iscid");

                    // set new action attribute
                    $("#supervisorApproveForm").attr("action", url);
                } else {
                    e.preventDefault();
                }
            });
            
            $('[name="btnSupervisorDisapprove"]').click(function(e){
                if (confirm("Are you sure not to approve this ISC?") == true) {
                    var url = $("#supervisorApproveForm").attr("action");
                    url += "disapprove/";
                    url += $(this).attr("data-iscid");

                    // set new action attribute
                    $("#supervisorApproveForm").attr("action", url);
                } else {
                    e.preventDefault();
                }
            });
            
            $('[name="btnSupervisorUpdate"]').click(function(e){         
                if (confirm("Are you sure to update data?") == true) {
                    var url = $("#supervisorApproveForm").attr("action");
                    url += "updateAnswers/";
                    url += $(this).attr("data-iscid");

                    // set new action attribute
                    $("#supervisorApproveForm").attr("action", url);
                }
            });
        });
    </script>