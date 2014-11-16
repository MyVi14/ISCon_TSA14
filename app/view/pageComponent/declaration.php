

<!-- ISC Form - Start Declaration Part -->
<div id="declaration">
	<h3>Declaration</h3>	
        
	<label for="approveISC"> By checking this checkbox, you agree this ISC </label>
	<input type="checkbox" name="approveISC" />
        <script>
            $(document).ready(function() {
                $("input[type='submit']").attr("disabled", true);

                $("input[type='checkbox']").click(function(e){
                    if ($(this).attr("checked") == "checked") {
                        $("input[type='submit']").attr("enabled", true);
                    } else
                        $("input[type='submit']").attr("disabled", true);
                });
            });
        </script>
		
	<p><input type="submit"> <input type="reset"> </p>
</div>
<!-- ISC Form - End Declaration Part -->



























