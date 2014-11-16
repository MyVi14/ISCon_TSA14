<?PHP
    include($headerLink);
?>

<!-- Start Home Div -->
<div id="supervisorSection">	
    
    <form action="" method="">
        <table name="" border="1" >
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
            <td><button name="btnNotApprove" data-iscid="<?PHP echo $isc->getISCID(); ?>"> Not Approve </button> </td>
            <td><button name="btnSubmitComponents" data-iscid="<?PHP echo $isc->getISCID(); ?>"> View Assessment Components </button> </td>
          </tr>
        <?PHP } ?>

        </table>

    </form>
    
</div>
<!-- End Home Div -->


?>

<?PHP
    include($footerLink);
?>