<?PHP
    include($headerLink);
?>

<!-- Start Home Div -->
<div id="studentSection">	
    <script>
        $(document).ready(function(){
            statusArray = $('td[name="statusCell"]');
            
            
            $.each(statusArray, function (index, cell){
                status = $(cell).attr("data-applicationStatus");
                line = "";
                
                if(status == "new") {
                    $('[name="btnSubmitISC"]').eq(index).attr("enabled", "true");
                    
                } else {
                    $('[name="btnSubmitISC"]').eq(index).attr("disabled", "true");
                }
            });
        
            
            status = $('td[name="statusCell"]').eq(2).attr("data-applicationStatus");
            
            
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
                url += "submitComponents/";
                url += $(this).attr("data-iscid");
                
                // set new action attribute
                $("#studentHomeForm").attr("action", url);
            });
            
            $('[name="btnSubmitISC"]').click(function(e){         
                var url = $("#studentHomeForm").attr("action");
                url += "create";
                
                // set new action attribute
                $("#studentHomeForm").attr("action", url);
            });
            
            
        });
        
    </script>
    <button><a href="<?PHP echo BASE_URL . 'public/ISCController/create'; ?>"> Create new ISC </a> </button>
    
    <form action="<?PHP echo BASE_URL . 'public/ISCController/'; ?>" method="POST" id="studentHomeForm">
        <table name="" class="table table-hover" >
          <tr>
            <th>ISC ID</th>
            <th>Application Type</th>
            <th>Created Date</th> 
            <th>Status</th>
            
          </tr>
          
        <?PHP foreach ($data as $isc) { ?>
          <tr>
            <td> <?PHP echo $isc->getISCID(); ?><input type="hidden" name="ISCID" value=" <?PHP echo $isc->getISCID(); ?>" /> </td>
            <td> <?PHP echo $isc->getApplicationType(); ?> </td>
            <td> <?PHP echo $isc->getCreatedDate(); ?> </td>
            <td name="statusCell" data-applicationStatus="<?PHP echo $isc->getApplicationStatus(); ?>"> <?PHP echo $isc->getApplicationStatus(); ?> </td>
            <td><button name="btnViewDetails" data-iscid="<?PHP echo $isc->getISCID(); ?>" > View Details </button> </td>
            <td><button name="btnSubmitISC" data-iscid="<?PHP echo $isc->getISCID(); ?>"> Submit ISC </button> </td>
            <td><button name="btnSubmitComponents" data-iscid="<?PHP echo $isc->getISCID(); ?>"> Submit Assessment Components </button> </td>
          </tr>
        <?PHP } ?>

        </table>

    </form>
    
</div>
<!-- End Home Div -->

<?PHP
    include($footerLink);
?>