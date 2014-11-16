<?PHP
    include($headerLink);
?>

    <script>
        $(document).ready(function(){
            $('[name="btnApprove"]').click(function(e){         
                var url = $("#supervisorHomeForm").attr("action");
                url += "SupervisorController/approve/";
                url += $(this).attr("data-iscid");
                
                // set new action attribute
                $("#supervisorHomeForm").attr("action", url);
            });
            
            $('[name="btnDisapprove"]').click(function(e){         
                var url = $("#supervisorHomeForm").attr("action");
                url += "SupervisorController/disapprove/";
                url += $(this).attr("data-iscid");
                
                // set new action attribute
                $("#supervisorHomeForm").attr("action", url);
            });
            
            $('[name="btnViewDetails"]').click(function(e){         
                var url = $("#supervisorHomeForm").attr("action");
                url += "ISCController/get/";
                url += $(this).attr("data-iscid");
                url += "/supervisor";
                
                // set new action attribute
                $("#supervisorHomeForm").attr("action", url);
            });
            
            
            
        });
    </script>

<!-- Start Home Div -->
<div id="supervisorSection">	
    
    <form action="<?PHP echo BASE_URL . 'public/'; ?>" method="POST" id="supervisorHomeForm">
        <table name="supervisorHomeTable" class="table table-hover">
          <tr>
            <th>ISC ID</th>
            <th>Application Type</th>
            <th>Created Date</th> 
            <th>Status</th>
            
          </tr>
          
        <?PHP foreach ($data as $isc) { ?>
          <tr>
            <td> <?PHP echo $isc->getISCID(); ?> </td>
            <td> <?PHP echo $isc->getApplicationType(); ?> </td>
            <td> <?PHP echo $isc->getCreatedDate(); ?> </td>
            <td> <?PHP echo $isc->getApplicationStatus(); ?> </td>
            <td><button name="btnViewDetails" data-iscid="<?PHP echo $isc->getISCID(); ?>"> View Details </button> </td>
            <td><button name="btnApprove" data-iscid="<?PHP echo $isc->getISCID(); ?>"> Approve </button> </td>
            <td><button name="btnDisapprove" data-iscid="<?PHP echo $isc->getISCID(); ?>"> Not Approve </button> </td>
            <td><button name="btnSubmitComponents" data-iscid="<?PHP echo $isc->getISCID(); ?>"> View Assessment Components </button> </td>
          </tr>
        <?PHP } ?>

        </table>

    </form>
    
</div>
<!-- End Home Div -->

<?PHP
    include($footerLink);
?>