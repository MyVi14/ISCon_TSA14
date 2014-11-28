<?PHP
    $title = "Student Home Page";
    include_once $studentHeader;
?>
<br />
<!-- Start Home Div -->
<div class="container">
<!--    <p><button><a href="<?PHP echo BASE_URL . 'public/ISCController/create'; ?>"> Create new ISC </a> </button></p>-->
    <form action="<?PHP echo BASE_URL . 'public/ISCController/'; ?>" method="POST" id="studentHomeForm">
        <table name="" class="table table-striped table-hover" >
          <tr>
            <th>ISC ID</th>
            <th>Application Type</th>
            <th>Created Date</th> 
            <th>Status</th>
            <th>Additional Comment</th>
          </tr>
          
        <?PHP foreach ($data as $isc) { ?>
          <tr>
            <td> <?PHP echo $isc->getISCID(); ?><input type="hidden" name="ISCID" value="<?PHP echo $isc->getISCID(); ?>" /> </td>
            <td> <?PHP echo $isc->getApplicationType(); ?> </td>
            <td> <?PHP echo $isc->getCreatedDate(); ?> </td>
            <td name="statusCell" data-applicationStatus="<?PHP echo $isc->getApplicationStatus(); ?>"> <?PHP echo $isc->getApplicationStatus(); ?> </td>
            <td> <?PHP echo $isc->getAdditionalComment(); ?> </td>
            <td><button name="btnViewDetails" data-iscid="<?PHP echo $isc->getISCID(); ?>" > View Details </button> </td>
            <td><button name="btnSubmitISC" data-iscid="<?PHP echo $isc->getISCID(); ?>"> Submit ISC </button> </td>
            <td><button name="btnSubmitComponents" data-iscid="<?PHP echo $isc->getISCID(); ?>"> Submit Assessment Components </button> </td>
          </tr>
        <?PHP } ?>

        </table>
    </form>
    
    <h2>Application Status Reference Table</h2>
    <table class="table table-striped table-bordered table-hover" width="400px">
        <tr>
            <th> Application Status </th>
            <th> Description </th>
        </tr>
    <?PHP
        require_once ROOT_PATH . 'app/controller/ISCController.php';

        $controller = new ISCController;
        $statusRef = $controller->getApplicationStatusReference();
        //var_dump($statusRef);
        
        foreach ($statusRef as $s) {
            echo '<tr>';
            echo '<td> '. $s["ApplicationStatus"].'</td>';
            echo '<td> '. $s["Description"].'</td>';
            echo '</tr>';
        }
    ?>
    </table>
</div>
<!-- End Home Div -->

    <script>
        $(document).ready(function(){
            statusArray = $('td[name="statusCell"]');
            
            $.each(statusArray, function (index, cell){
                status = $(cell).attr("data-applicationStatus");
                
                if(status == "New") {
                    $('[name="btnSubmitISC"]').eq(index).attr("enabled", "true");
                    
                } else {
                    $('[name="btnSubmitISC"]').eq(index).attr("disabled", "true");
                }
            });
        
            $('[name="btnViewDetails"]').click(function(e){         
                var url = $("#studentHomeForm").attr("action");
                url += "get/";
                url += $(this).attr("data-iscid");
                url += "/student";
                
                // set new action attribute
                $("#studentHomeForm").attr("action", url);
            });
            
            $('[name="btnSubmitComponents"]').click(function(e){         
                var url = $("#studentHomeForm").attr("action");
                url += "assessmentComponent/";
                url += $(this).attr("data-iscid");
                url += "/student";
                // set new action attribute
                $("#studentHomeForm").attr("action", url);
            });
            
            $('[name="btnSubmitISC"]').click(function(e){         
                var url = $("#studentHomeForm").attr("action");
                url += "create?section=B";
                
                // set new action attribute
                $("#studentHomeForm").attr("action", url);
            }); 
        });
    </script>

<?PHP
    include($footerLink);
?>