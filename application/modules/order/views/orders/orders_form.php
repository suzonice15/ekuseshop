<div class="form-group">
	<label for="shiftName" class="col-sm-3 control-label">Expense Category Name</label>

	<div class="col-sm-8">
		<input  required type="text"  class="form-control" name="expense_cat_name"
				value="<?php if (isset($expense)) echo $expense->expense_cat_name; ?>" placeholder="Category Name">
		<input type="hidden" id="shiftId" name="expense_cat_id" value="<?php if (isset($expense)) echo $expense->expense_cat_id; ?>">
	</div>
</div>
<br>
<br>

