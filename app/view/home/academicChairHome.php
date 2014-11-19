<?PHP
    $title = "Academic Chair Home Page";
    include($headerLink);
?>

    <script>
        $(document).ready(function(){
            $('[name="btnApprove"]').click(function(e){         
                var url = $("#supervisorHomeForm").attr("action");
                url += "AcademicChairController/approve/";
                url += $(this).attr("data-iscid");
                
                // set new action attribute
                $("#supervisorHomeForm").attr("action", url);
            });
            
            $('[name="btnDisapprove"]').click(function(e){         
                var url = $("#supervisorHomeForm").attr("action");
                url += "AcademicChairController/disapprove/";
                url += $(this).attr("data-iscid");
                
                // set new action attribute
                $("#supervisorHomeForm").attr("action", url);
            });
            
            $('[name="btnViewDetails"]').click(function(e){         
                var url = $("#supervisorHomeForm").attr("action");
                url += "ISCController/get/";
                url += $(this).attr("data-iscid");
                url += "/academicChair";
                
                // set new action attribute
                $("#supervisorHomeForm").attr("action", url);
            });
            
            
            
        });
    </script>

<!-- Start Home Div -->
<div id="supervisorSection">	
<input type='button' name='requestInfo' value='Request Information' class='osx' />

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
          </tr>
        <?PHP } ?>

        </table>

    </form>
    
</div>
<!-- End Home Div -->

<?PHP
    include($footerLink);
?>

<!-- modal content -->
<div id="osx-modal-content">
    <div id="osx-modal-title"> Send email to request more information </div>
    <div class="close"><a href="#" class="simplemodal-close">x</a></div>
    <div id="osx-modal-data">

        <h2>Compose an email</h2>

        <form class="form-horizontal" role="form" action="<?PHP echo BASE_URL . 'public/System/email/'; ?>" method="POST" id="emailForm" enctype="multipart/form-data" >
            <div class="form-group">
              <label class="control-label col-sm-2" for="toEmail">Receiver Email:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="toEmail" name="toEmail" placeholder="email of receiver" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="receiverName">Receiver Name:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="toName" name="toName" placeholder="name of receiver" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="fromEmail">Sender Email:</label>
              <div class="col-sm-10"> 
                <input type="email" class="form-control" id="fromEmail" name="fromEmail" placeholder="email of sender" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="senderName">Sender Name:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="fromName" name="fromName" placeholder="name of receiver" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="subject">Subject:</label>
              <div class="col-sm-10"> 
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="body">Body:</label>
              <div class="col-sm-10"> 
                  <textarea cols="10" rows="5" class="form-control" id="body" name="body" placeholder="email body" /></textarea>
              </div>
            </div>
<!--            <div class="form-group">
              <label class="control-label col-sm-2" for="emailAttachment">Attach File:</label>
              <div class="col-sm-10"> 
                  <input type="file" class="form-control" name="emailAttachment" />
              </div>
            </div>-->
            <div class="form-group"> 
              <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" id="btnSendEmail" class="btn btn-default">Submit</button>
                <button class="simplemodal-close btn btn-default">Close</button> <span>(or press ESC or click the overlay)</span>
              </div>
            </div>
        </form>
        
        <div id="result" class="bg-info">
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        // Attach a submit handler to the form
        $( "#emailForm" ).submit(function( event ) {

          // Stop form from submitting normally
          event.preventDefault();
          
          // change class of btnSendEmail button
          $("#btnSendEmail").addClass(".active btn-info");
          
          url = $(this).attr("action");

          // Get form data
          postData =  $(this).serialize();
          
          // Send the data using post
          var posting = $.post( url , postData );
          
          $( "#result" ).empty().append( "sending email..." );
          
          // Put the results in a div
          posting.done(function( data ) {
            $( "#result" ).empty().append( data );
            $("#btnSendEmail").removeClass(".active btn-info");
          });
        });
    });
</script>
<script type='text/javascript' src='<?PHP echo BASE_URL . "public/js/jquery.simplemodal.js"; ?>'></script>
<script type='text/javascript' src='<?PHP echo BASE_URL . "public/js/osx.js"; ?>'></script>
