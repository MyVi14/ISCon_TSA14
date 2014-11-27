<?PHP
    if(isset($ISCObj)) {
        $supervisorArray = $ISCObj->getSupervisorAnswer();
        if( count($supervisorArray) > 0 ) {
            $count = 0;
            
            $item1 = $supervisorArray[$count++];
            $item2 = $supervisorArray[$count++];
            $item3 = $supervisorArray[$count++];
            $item4 = $supervisorArray[$count++];
            $item5a = $supervisorArray[$count++];
            $item5b = $supervisorArray[$count++];
            $item5c = $supervisorArray[$count++];
            $item5d = $supervisorArray[$count++];
            $item5e = $supervisorArray[$count++];
            $item6 = $supervisorArray[$count++];
            $item7 = $supervisorArray[$count++];
            $item8 = $supervisorArray[$count++];
            $item9 = $supervisorArray[$count++];
        }
    }
?>

<!-- ISC Form - Start Section B -->
<div class="container">
    
    
    <h3 class="bg-warning"> Section C - Supervisor </h3>

    <table class="table table-hover">
    <tr>
        <td>1.</td>
        <td><label> Apart from your time and normal library facilities, 
                are any facilities or resources required for the contract 
                (e.g. special literature, equipment, technical assistance, transport, 
                maintenance costs, laboratory space)?</label></td>
        <td>YES</td>
        <td><input type="radio" name="item1" value="yes" <?PHP if(isset($item1) && ($item1["yesNoAnswer"] == 'yes')) echo 'checked="checked"'; ?> ></td>
        <td>NO</td>
        <td><input type="radio" name="item1" value="no" <?PHP if(isset($item1) && ($item1["yesNoAnswer"] == 'no')) echo 'checked="checked"'; ?> ></td>
    </tr>

    <tr>
        <td></td>
        <td>If so, are they available?</td>
        <td>YES</td>
        <td><input type="radio" name="item1Comment" value="yes" <?PHP if(isset($item1) && ($item1["comment"] == 'yes')) echo 'checked="checked"'; ?> ></td>
    <h1><?PHP echo $item["comment"]; ?> </h1>
        <td>NO</td>
        <td><input type="radio" name="item1Comment" value="no" <?PHP if(isset($item1) && ($item1["comment"] == 'no')) echo 'checked="checked"'; ?> ></td>
    </tr>

    <tr>
        <td>2.</td>
        <td><strong>Apart from associate supervision, does the contract involve other institutions, organisations or persons?</strong> <p><em>If so, please attach confirmation that this support will be available.</em></p> </td>
        <td>YES</td>
        <td><input type="radio" name="item2" value="yes" <?PHP if(isset($item2) && ($item2["yesNoAnswer"] == 'yes')) echo 'checked="checked"'; ?> ></td>
        <td>NO</td>
        <td><input type="radio" name="item2" value="no" <?PHP if(isset($item2) && ($item2["yesNoAnswer"] == 'no')) echo 'checked="checked"'; ?> ></td>
    </tr>

    <tr>
        <td>3.</td>
        <td><label>Does the contract involve overseas travel?</label>
            <p>If so, please indicate the cost and how this will be met:
                <textarea rows="3" cols="50" name="item3Comment"><?PHP if(isset($item3) && isset($item3["comment"])) echo $item3["comment"]; ?></textarea>
            </p>
        </td>
        <td>YES</td>
        <td><input type="radio" name="item3" value="yes" <?PHP if(isset($item3) && ($item3["yesNoAnswer"] == 'yes')) echo 'checked="checked"'; ?>></td>
        <td>NO</td>
        <td><input type="radio" name="item3" value="no" <?PHP if(isset($item3) && ($item3["yesNoAnswer"] == 'no')) echo 'checked="checked"'; ?> ></td>
    </tr>

    <tr>
        <td>4.</td>
        <td><label>Are there any confidentiality restrictions on publication of the results of this contract?</label>
            <p>If so, please attach a statement providing details of the nature 
                of the restriction, the reasons for this, and the rights of the student to any 
                intellectual property involved in the work.</p>
        </td>
        <td>YES</td>
        <td><input type="radio" name="item4" value="yes" <?PHP if(isset($item4) && ($item4["yesNoAnswer"] == 'yes')) echo 'checked="checked"'; ?> ></td>
        <td>NO</td>
        <td><input type="radio" name="item4" value="no" <?PHP if(isset($item4) && ($item4["yesNoAnswer"] == 'no')) echo 'checked="checked"'; ?> ></td>
    </tr>


    <tr>
        <td>5.</td>
        <td colspan="5"> <label> Does the contract involve: </label> </td>
    </tr>

    <tr>
        <td><p></p></td>
        <td>a. Research with human subjects (e.g. experimental work, interviews, surveys or observation)?</td>
        <td>YES</td>
        <td><input type="radio" name="item5a" value="yes" <?PHP if(isset($item5a) && ($item5a["yesNoAnswer"] == 'yes')) echo 'checked="checked"'; ?> ></td>
        <td>NO</td>
        <td><input type="radio" name="item5a" value="no" <?PHP if(isset($item5a) && ($item5a["yesNoAnswer"] == 'no')) echo 'checked="checked"'; ?> ></td>
    </tr>

    <tr>
        <td><p></p></td>
        <td>b. Work with animals or animal materials?</td>
        <td>YES</td>
        <td><input type="radio" name="item5b" value="yes" <?PHP if(isset($item5b) && ($item5b["yesNoAnswer"] == 'yes')) echo 'checked="checked"'; ?> ></td>
        <td>NO</td>
        <td><input type="radio" name="item5b" value="no" <?PHP if(isset($item5b) && ($item5b["yesNoAnswer"] == 'no')) echo 'checked="checked"'; ?> ></td>
    </tr>


    <tr>
        <td><p></p></td>
        <td>c. Work with flora? </td>
        <td>YES</td>
        <td><input type="radio" name="item5c" value="yes" <?PHP if(isset($item5c) && ($item5c["yesNoAnswer"] == 'yes')) echo 'checked="checked"'; ?> ></td>
        <td>NO</td>
        <td><input type="radio" name="item5c" value="no" <?PHP if(isset($item5c) && ($item5c["yesNoAnswer"] == 'no')) echo 'checked="checked"'; ?> ></td>
    </tr>

    <tr>
        <td><p></p></td>
        <td>d. Matters of a hazardous nature (e.g. potentially biohazardous procedures and situations the use and disposal of hazardous chemicals, or the use of ionising radiation)?</td>
        <td>YES</td>
        <td><input type="radio" name="item5d" value="yes" <?PHP if(isset($item5d) && ($item5d["yesNoAnswer"] == 'yes')) echo 'checked="checked"'; ?> ></td>
        <td>NO</td>
        <td><input type="radio" name="item5d" value="no" <?PHP if(isset($item5d) && ($item5d["yesNoAnswer"] == 'no')) echo 'checked="checked"'; ?> ></td>
    </tr>

    <tr>
        <td><p></p></td>
        <td>e. Research on a matter of special political or social sensitivity?</td>
        <td>YES</td>
        <td><input type="radio" name="item5e" value="yes" <?PHP if(isset($item5e) && ($item5e["yesNoAnswer"] == 'yes')) echo 'checked="checked"'; ?> ></td>
        <td>NO</td>
        <td><input type="radio" name="item5e" value="no" <?PHP if(isset($item5e) && ($item5e["yesNoAnswer"] == 'no')) echo 'checked="checked"'; ?> ></td>
    </tr>

    <tr>
        <td colspan="6"> 
            If yes, please provide (in conjunction with the student) a separate page 
            indicating the potential problems or difficulties and the way these will be addressed.  
            In some cases, permission may be required from the appropriate body before the contract 
            can proceed (this can take a few weeks, so follow it up early). 
            Where such approval has been obtained, please give details and cite the permit or 
            license number or other proof of approval.
        </td>
    </tr>

    <tr>
        <td>6.</td>
        <td colspan="5"><label>Please comment upon the student capacity to undertake the contract and 
                your assessment of the quality of the proposed ISC.</label></td>
    </tr>
    
    <tr>
        <td colspan="6">
            <textarea rows="3" cols="100" name="item6"><?PHP if( isset($item6) ) echo $item6["textAnswer"]; ?></textarea>
        </td>
    </tr>

    <tr>
        <td>7.</td>
        <td colspan="5"> <label>Outline the nature and frequency of expected contact with the student.
                (If contract is to be studied externally, specific detail is required). </label> </td>
    </tr>

    <tr>
        <td colspan="6">
            <textarea rows="3" cols="100" name="item7"><?PHP if( isset($item7) ) echo $item7["textAnswer"]; ?></textarea> 
        </td>
    </tr>

    <tr>
        <td>8. </td>
        <td>  
            <label>How many other Independent Study Contracts have you agreed to 
                supervise during the same period as this contract? </label>
            <input type="text" name="item8" value="<?PHP if( isset($item8) ) echo $item8["textAnswer"]; ?>" />
        </td>
        
    </tr>

    <tr>
        <td>9.</td>
        <td> <label> Does the nature of the contract involve any problems relating to personal and commercial confidentiality? </label> </td>
        <td>YES</td>
        <td><input type="radio" name="item9" value="yes" <?PHP if(isset($item9) && ($item9["yesNoAnswer"] == 'yes')) echo 'checked="checked"'; ?> ></td>
        <td>NO</td>
        <td><input type="radio" name="item9" value="no" <?PHP if(isset($item9) && ($item9["yesNoAnswer"] == 'no')) echo 'checked="checked"'; ?> ></td>
    </tr>

</table>

<label>Please ensure that that Academic Chair has agreed to this ISC, if applicable. </label>

</div>
<!-- ISC Form - End Section B -->



