<div class="form-group">
	<label for="shiftName" class="col-sm-3 control-label">Courier  Name</label>

	<div class="col-sm-8">
		<input  required type="text"  class="form-control" name="courier_name"
				value="<?php if (isset($courier)) echo $courier->courier_name; ?>" placeholder="Courier Name">
		<input type="hidden"   name="courier_id" value="<?php if (isset($courier)) echo $courier->courier_id; ?>">
	</div>
</div>


<div class="form-group">
	<label for="shiftName" class="col-sm-3 control-label">Courier  Type</label>

	<div class="col-sm-8">
		<select name="courier_status" class="form-control">
			<option value="1">Inside Dhaka</option>
			<option value="2">OutSide Dhaka</option>
		</select>
	</div>
</div>

<br>
<br>

