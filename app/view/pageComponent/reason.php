

<!-- ISC Form - Start Reason Part -->
<div id="declaration">
	
    <form method="POST" action="<?PHP echo BASE_URL . "public/SchoolDeanController/disapprove/" . $data["ISCID"]; ?>" role="form">
        <label> Please give a reason why you do not approve </label>
        <textarea rows="2" cols="30" name="reason"></textarea>

        <p><input type="reset"> <input type="submit"> </p>

    </form>
</div>
<!-- ISC Form - End Reason Part -->




























