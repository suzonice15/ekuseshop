
<input required type="hidden" id="category_title" class="form-control the_title" name="page_id" value="<?php if(isset($page)){ echo $page->page_id;} ?>">
	<div class="form-group ">
		<label for="category_title"> Page Name<span class="required">*</span></label>
		<input required type="text" id="category_title" class="form-control the_title" name="page_name" value="<?php if(isset($page)){ echo $page->page_name;} ?>">

	</div>
	<div class="form-group "> <label for="category_name">Page Link<span class="required">*</span></label>
		<input  required type="text" class="form-control the_name" id="category_name" name="page_link" value="<?php if(isset($page)){ echo $page->page_link;} ?>">
	</div>
	<div class="form-group ">
		<label for="page_template">Select Template</label>
		<select name="page_template" class="form-control" id="page_template">
			<option value="default" >Default</option>
			<option value="full_width">Full Width</option>
			<option value="contact">Contact</option>
			<option value="trackorder">Track Order</option>
		</select>
	</div>



	<div class="form-group ">
		<label for="page_content">Page Content</label>
		<textarea   id="editor1"  name="page_content"  rows="10" cols="50" class="form-control" id="page_content">
<?php if(isset($page)){ echo $page->page_content;} ?>
		</textarea>
	</div>

