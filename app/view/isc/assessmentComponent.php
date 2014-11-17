<?PHP
    include($headerLink);
    $ISCID = $data["ISCID"];
    $components = $data["components"];
    $who = $data["who"];
    
?>

<script>
    $(document).ready(function(){
        btnSubmitArray = $("button[name='btnSubmitComponent']");
        
        $.each(btnSubmitArray, function (index, cell){
           $(cell).css("display", "none");     
        });
        
        $("button[name='btnSubmitComponent']").click(function(e){
            var url = $("#assessmentComponentForm").attr("action");
            url += "submitComponent/";
            url += $(this).attr("data-componentid");
            
            // set new action attribute
            $("#assessmentComponentForm").attr("action", url);
        });
        
        // real button to submit to server
        $("button[name='submitComponent']").click(function(e){
            newContent = '<input type="file" name="FileUpload" /> ';
            
            $(this).siblings("button[name='btnSubmitComponent']").css("display", "inline");
            
            $(this).replaceWith(newContent);
        });
        
        $("button[name='btnSubmitResult']").click(function(e){
            var url = $("#assessmentComponentForm").attr("action");
            url += "submitResult/";
            url += $(this).attr("data-componentid");
            
            // set new action attribute
            $("#assessmentComponentForm").attr("action", url);
            //$("#assessmentComponentForm").attr("enctype", "");
        });
        
    });
</script>

<form action="<?PHP echo BASE_URL . 'public/ISCController/'; ?>" method="POST" enctype="multipart/form-data" id="assessmentComponentForm">
<h3> ISCID <?PHP echo $ISCID; ?> </h3>

<input type="hidden" name="ISCID" value="<?PHP echo $ISCID; ?>" />
<table class="table table-hover">
    <thead>
        <tr>
            <th>ComponentID</th>
            <th>Description</th>
            <th>Word Length</th>
            <th>Percentage</th>
            <th>Due date</th>
            <th>Mark</th>
            <th>Comment</th>
            <th>File Upload</th>
        </tr>
    </thead>
    <tbody>
        <?PHP foreach($components as $component) { ?>
        <tr>
            
            <td><?PHP echo $component["ComponentID"]; ?></td>
            <td><?PHP echo $component["Description"]; ?></td>
            <td><?PHP echo $component["WordLength"]; ?></td>
            <td><?PHP echo $component["Percentage"]; ?></td>
            <td><?PHP echo $component["DueDate"]; ?></td>
            <td> <input type="number" name="mark<?PHP echo $component['ComponentID']; ?>" min="0" max="100" value="<?PHP echo $component['Mark']; ?>" 
                <?PHP if ($who == 'student') echo 'readonly="readonly"'; ?> />
            </td>
            <td><textarea type="text" name="comment<?PHP echo $component['ComponentID']; ?>" cols="25" rows="3"
                        <?PHP if ($who == 'student') echo 'readonly="readonly"'; ?> >
                    <?PHP echo $component['Comment']; ?>
                </textarea>
            </td>
            <td>
                <?PHP if($component["FileUpload"] == null) { ?>
                    <button name="submitComponent"> Submit component</button>
                    <br />
                    <button name="btnSubmitComponent" data-componentid="<?PHP echo $component['ComponentID']; ?>" > Submit </button>
                <?PHP } else {
                     echo '<a href="'. BASE_URL .'app/upload/'.$component["FileUpload"].'"> '.$component["FileUpload"].' </a>';
                }?>
            </td>
            
            <?PHP if($who == 'supervisor') { ?>
            
                <td><button name="btnSubmitResult" data-componentid="<?PHP echo $component['ComponentID']; ?>" > Submit Result </button></td>
            
            <?PHP } ?>
        </tr>
        <?PHP } ?>
    </tbody>
</table >
</form>

<?PHP
    include($footerLink);
?>
