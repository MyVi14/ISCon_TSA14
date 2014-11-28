<?PHP
    $title = "School Dean Home Page";
    include($schoolDeanHeader);
?>
<br />
<!-- Start Home Div -->
<div id="supervisorSection">	
    
    <form action="<?PHP echo BASE_URL . 'public/'; ?>" method="POST" id="supervisorHomeForm">
        <table name="supervisorHomeTable" class="table table-striped table-hover">
          <tr>
            <th>ISC ID</th>
            <th>Application Type</th>
            <th>Created Date</th> 
            <th>Status</th>
            <th>Additional Comment</th>
          </tr>
          
        <?PHP foreach ($data as $isc) { ?>
          <tr>
            <td> <?PHP echo $isc->getISCID(); ?> </td>
            <td> <?PHP echo $isc->getApplicationType(); ?> </td>
            <td> <?PHP echo $isc->getCreatedDate(); ?> </td>
            <td> <?PHP echo $isc->getApplicationStatus(); ?> </td>
            <td> <?PHP echo $isc->getAdditionalComment(); ?> </td>
            <td><button name="btnViewDetails" data-iscid="<?PHP echo $isc->getISCID(); ?>"> View Details </button> </td>
            <td><button name="btnApprove" data-iscid="<?PHP echo $isc->getISCID(); ?>"> Approve </button> </td>
<!--            <td><button name="btnDisapprove" data-iscid="<?PHP echo $isc->getISCID(); ?>"> Not Approve </button> </td>-->
            <td><input type='button' name='osx' value='Not Approve' class='osx' data-iscid="<?PHP echo $isc->getISCID(); ?>" /></td>
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

<?PHP
    include($footerLink);
?>

<!-- modal content -->
<div id="osx-modal-content">
    <div id="osx-modal-title"> ISCID: <span id="spanISCID"></span> </div>
    <div class="close"><a href="#" class="simplemodal-close">x</a></div>
    <div id="osx-modal-data">

        <h2>Why don't you approve?</h2>

        <form class="form-horizontal" role="form" action="<?PHP echo BASE_URL . 'public/SchoolDeanController/disapprove/'; ?>" method="POST" id="reasonForm" >
            <input type="hidden" name="ISCID" value="" />
            <div class="form-group">
              <label class="control-label col-sm-2" for="reason">Reason:</label>
              <div class="col-sm-10"> 
                  <textarea cols="10" rows="5" class="form-control" id="body" name="reason" placeholder="reason" /></textarea>
              </div>
            </div>

            <div class="form-group"> 
              <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" id="btnSendReason" class="btn btn-default">Submit</button>
                  <button class="simplemodal-close btn btn-default" onclick="location.reload()">Close</button> <span>(or press ESC or click the overlay)</span>
              </div>
            </div>
        </form>
        <div id="result" class="bg-info">
        </div>
    </div>
</div>

    <script>
        $(document).ready(function(){
            $('[name="btnApprove"]').click(function(e){
                if (confirm("Are you sure to approve this ISC?") == true) {
                    var url = $("#supervisorHomeForm").attr("action");
                    url += "SchoolDeanController/approve/";
                    url += $(this).attr("data-iscid");

                    // set new action attribute
                    $("#supervisorHomeForm").attr("action", url);
                } else {
                    e.preventDefault();
                }
            });
            
            $('[name="btnDisapprove"]').click(function(e){
                if (confirm("Are you sure not to approve this ISC?") == true) {
                    var url = $("#supervisorHomeForm").attr("action");
                    url += "SchoolDeanController/reason/";
                    url += $(this).attr("data-iscid");

                    // set new action attribute
                    $("#supervisorHomeForm").attr("action", url);
                } else {
                    e.preventDefault();
                }
            });
            
            $('[name="btnViewDetails"]').click(function(e){         
                var url = $("#supervisorHomeForm").attr("action");
                url += "ISCController/get/";
                url += $(this).attr("data-iscid");
                url += "/schoolDean";
                
                // set new action attribute
                $("#supervisorHomeForm").attr("action", url);
            });
            
            
            
        });
    </script>

<script>
    $(document).ready(function (){
        $('input[name="osx"]').click(function(e){         
            iscid = $(this).attr("data-iscid");
            
            $("#spanISCID").append(iscid);
            
            // set ISCID for hidden input
            $("#reasonForm").children("input[name='ISCID']").attr("value", iscid);
        });
        
        $("#reasonForm").submit(function(e){
            e.preventDefault();
            
            url = $(this).attr("action");

            // Get form data
            postData =  $(this).serialize();

              // Send the data using post
            var posting = $.post( url , postData );

            $( "#result" ).empty().append( "Processing. Please wait..." );

            // Put the results in a div
            posting.done(function( data ) {
                $( "#result" ).empty().append( data );
            });
            
        });
    });
</script>

<script type='text/javascript' src='<?PHP echo BASE_URL . "public/js/jquery.simplemodal.js"; ?>'></script>
<script type='text/javascript' src='<?PHP echo BASE_URL . "public/js/osx.js"; ?>'></script>
