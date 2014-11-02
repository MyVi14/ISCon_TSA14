
<!-- ISC Form - Start Section A -->
<div id="sectionA">
	<h4>Section A - Personal Details</h4>	
	
	<form method="POST" action="" onSubmit="return validate(this)">
	
	<table>
		<tr>
			<td><label>Student Number</label>
			<td><input name="studentNo" type="text" size="20">
		</tr>
		<tr>
			<td><label>Surname</label>
			<td><input name="surname" type="text" size="20">
		</tr>
		<tr>
			<td><label>Given Name</label>
			<td><input name="givenName" type="text" size="20">
		</tr>
	</table>
	
	<p> Student Contact Details </p>
	
	<textarea readonly rows="4" cols="45">
	The University will use the email, 
	telephone and address details recorded in MyInfo to contact you.
	Please ensure these are up to date.
	</textarea>
	
	<br /><br />
	
	<p> Please confirm :
		I have not already completed the maximum of two ISCs for this course. </p>
	
	<input type="radio" name="maximumCompleted" value="yes"> Yes <br />
	<input type="radio" name="maximumCompleted" value="no"> No </p>
	
	<p>I am enrolled in the Doctor of Psychology and have not already completed the maximum of 9 points of ISCs. </p>
	<input type="radio" name="confirmMaximumPoints" value="yes">Yes<br />
	<input type="radio" name="confirmMaximumPoints" value="no">No<br />
	
	<p> Application type:</p>

	<input type="radio" name="applicationType" value="undergraduate">Undergraduate ISC<br />
	<input type="radio" name="applicationType" value="postgraduate">Postgraduate ISC<br />

	</form>
</div>
<!-- ISC Form - End Section A -->




























