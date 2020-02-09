
<input  type="hidden" id="category_title" class="form-control the_title" name="review_id" value="<?php if(isset($riview)){ echo $riview->review_id;} ?>">
	<div class="form-group ">
		<label for="category_title"> Customer Name<span class=""></span></label>
		<input  type="text" id="category_title" class="form-control the_title" name="name" value="<?php if(isset($riview)){ echo $riview->name;} ?>">

	</div>
	<div class="form-group "> <label for="category_name">Customer Email<span class=""></span></label>
		<input   type="text" class="form-control the_name" id="category_name" name="email" value="<?php if(isset($riview)){ echo $riview->email;} ?>">
	</div>
	<div class="form-group ">
		<label for="page_template">Rivew status</label>
		<select name="review_active" class="form-control" id="page_template">
			<option value="1" >Publish</option>
			<option value="0" >Unpublish</option>

		</select>
	</div>


<div class="form-group ">
	<label for="page_template">Customer rating  </label>

	<input  type="text" id="category_title" class="form-control the_title" name="rating" value="<?php if(isset($riview)){ echo $riview->rating;} ?>">

</div>


	<div class="form-group ">
		<label for="page_content">Page Content</label>
		<textarea name="comment"  rows="10" cols="50" class="form-control" id="page_content">
<?php if(isset($riview)){ echo $riview->comment;} ?>
		</textarea>
	</div>

