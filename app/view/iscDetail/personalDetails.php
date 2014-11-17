<!-- This page use an object called $ISCObj to set up data, if no such object is found, no data is printed -->

<!-- ISC Form - Start Section A -->
<div id="personalDetails" style="margin-left: 10px" >
    <h1 class="bg-warning"> Section A - Personal Details</h1>

    <div class="form-group">
        <label>Student Number</label>
        <input name="studentNo" type="text" size="20" value="<?PHP if(isset($ISCObj)) echo $ISCObj->getStudentNo(); ?>">
    </div>
    
    <div class="form-group">
        <label>Surname</label>
        <input name="studentSurname" type="text" size="20" value="<?PHP if(isset($ISCObj)) echo $ISCObj->getSurname(); ?>">
    </div>
    
    <div class="form-group">
        <label>Given Name</label>
        <input name="studentGivenName" type="text" size="20" value="<?PHP if(isset($ISCObj)) echo $ISCObj->getGivenName(); ?>">
    </div>
    
    <div class="form-group">
        <label>Phone No</label>
        <input name="studentEmail" type="tel" size="20" value="<?PHP if(isset($ISCObj)) echo $ISCObj->getEmail(); ?>" />
    </div>
    
    <div class="form-group">
        <label>Email</label>
        <input name="studentPhoneNo" type="email" size="20" value="<?PHP if(isset($ISCObj)) echo $ISCObj->getPhoneNo(); ?>" />
    </div>

    <br />

    <label> Please confirm : I have not already completed the maximum of two ISCs for this course. </label>
    
    <div class="radio">
        <label><input type="radio" name="confirmMaximumISC" value="yes" <?PHP if(isset($ISCObj) && (strtolower($ISCObj->getConfirmMaximumISC()) == 'yes')) echo 'checked="checked"'; ?> /> Yes </label>
    </div>
    <div class="radio">
        <label><input type="radio" name="confirmMaximumISC" value="no" <?PHP if(isset($ISCObj) && (strtolower($ISCObj->getConfirmMaximumISC()) == 'no')) echo 'checked="checked"'; ?> /> No </label>
    </div>
    
    <label>I am enrolled in the Doctor of Psychology and have not already completed the maximum of 9 points of ISCs. </label>
    <div class="radio">
        <label><input type="radio" name="enrollInPHD" value="yes" <?PHP if(isset($ISCObj) && (strtolower($ISCObj->getEnrollInPHD()) == 'yes')) echo 'checked="checked"'; ?> /> Yes </label>
    </div>
    <div class="radio">
        <label><input type="radio" name="enrollInPHD" value="no" <?PHP if(isset($ISCObj) && (strtolower($ISCObj->getEnrollInPHD()) == 'no')) echo 'checked="checked"'; ?> /> No </label>
    </div>
    
    <label> Application type:</label>
    <div class="radio">
        <label><input type="radio" name="applicationType" value="undergraduate" <?PHP if(isset($ISCObj) && (strtolower($ISCObj->getApplicationType()) == 'undergraduate')) echo 'checked="checked"'; ?> /> Undergraduate ISC </label>
    </div>
    <div class="radio">
        <label><input type="radio" name="applicationType" value="postgraduate" <?PHP if(isset($ISCObj) && (strtolower($ISCObj->getApplicationType()) == 'postgraduate')) echo 'checked="checked"'; ?>/> Postgraduate ISC </label>
    </div>
</div>
<!-- ISC Form - End Section A -->
