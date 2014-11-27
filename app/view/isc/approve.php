<?PHP
    $title = "Approve ISC Page";
    include($headerLink);
    
    $ISCID = $data["ISCID"];
    $who = $data["who"];
?>

<?php
    if ($who == "supervisor") {
        echo "<h3> Fill in data for ISCID: $ISCID </h3>";
        echo '<form action="'.BASE_URL.'public/SupervisorController/" method="POST" id="supervisorApproveForm" >';
        include_once ROOT_PATH. 'app/view/iscDetail/supervisorAnswer.php';
        
        echo '<label> Are you willing to supervise this ISC? </label>';
        echo '<p>';
        echo '<button data-iscid="'.$ISCID.'" name="btnSupervisorApprove"> Agree </button>';
        echo '<button data-iscid="'.$ISCID.'" name="btnSupervisorUpdate"> Update </button>';
        echo '<button data-iscid="'.$ISCID.'" name="btnSupervisorDisapprove"> Not Agree </button>';
        echo '</p>';
        echo '</form>';
    }
?>

<?PHP
    include($footerLink);
?>

<script>
        $(document).ready(function(){
            $('[name="btnSupervisorApprove"]').click(function(e){         
                var url = $("#supervisorApproveForm").attr("action");
                url += "submitAnswers/";
                url += $(this).attr("data-iscid");
                
                // set new action attribute
                $("#supervisorApproveForm").attr("action", url);
            });
            
            $('[name="btnSupervisorDisapprove"]').click(function(e){         
                var url = $("#supervisorApproveForm").attr("action");
                url += "disapprove/";
                url += $(this).attr("data-iscid");
                
                // set new action attribute
                $("#supervisorApproveForm").attr("action", url);
            });
            
            $('[name="btnSupervisorUpdate"]').click(function(e){         
                var url = $("#supervisorApproveForm").attr("action");
                url += "updateAnswers/";
                url += $(this).attr("data-iscid");
                
                // set new action attribute
                $("#supervisorApproveForm").attr("action", url);
            });
            
        });
    </script>