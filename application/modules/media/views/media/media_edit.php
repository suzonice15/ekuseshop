<div class="col-md-offset-0 col-md-12">

<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $title; ?></h3>


	</div>
	<div class="box-body">



		<form method="POST" action="<?=base_url('category-update')?>" enctype="multipart/form-data">
			<div class="box-body">
				<div class="form-group <?=form_error('category_title') ? 'has-error' : ''?>">
					<label for="category_title">Title<span class="required">*</span></label>
					<input type="text" class="form-control the_title" name="category_title" value="<?=set_value('category_title') ? set_value('category_title') : isset($category->category_title) ? $category->category_title : NULL?>">
				</div>

				<div class="form-group <?=form_error('category_name') ? 'has-error' : ''?>">
					<label for="category_name">Name<span class="required">*</span></label>
					<input type="text" class="form-control the_name" name="category_name" value="<?=set_value('category_name') ? set_value('category_name') : isset($category->category_name) ? $category->category_name : NULL?>">
				</div>

				<div class="form-group <?=form_error('parent_id') ? 'has-error' : ''?>">
					<?php
					$categories = get_categories();
					//echo '<pre>'; print_r($categories); echo '</pre>';
					$option = NULL;
					foreach($categories as $cat)
					{
						if(set_value('parent_id') == $cat->category_id){ $selected='selected'; }elseif(isset($category->parent_id) && $category->parent_id == $cat->category_id){ $selected='selected'; }else{ $selected=NULL; }


						$option.='<option value="'.$cat->category_id.'" '.$selected.'>'.$cat->category_title.'</option>';
					}
					?>
					<label for="category_name">Select Parent</label>
					<select class="form-control select2" name="parent_id">
						<option value="0">--- choose ---</option>
						<?php echo $option; ?>
					</select>
				</div>

				<div class="form-group featured-image">
					<label>Category Icon</label>
					<?php
					$featured_image = get_media_path($category->media_id);
					if(!empty($featured_image))
					{
						?><div class="row">
						<div class="col-sm-1">
							<img src="<?=$featured_image?>" width="33" height="33">
						</div>
						<div class="col-sm-11">
							<input type="file" class="form-control" name="featured_image">
						</div>
						</div><?php
					}
					else
					{
						?><input type="file" class="form-control" name="featured_image"><?php
					}
					?>
				</div>

				<div class="form-group featured-image">
					<label>Banner Image</label>
					<?php
					$medium_banner = get_media_path($category->medium_banner);
					if(!empty($medium_banner))
					{
						?><div class="row">
						<div class="col-sm-1">
							<img src="<?=$medium_banner?>" width="33" height="33">
						</div>
						<div class="col-sm-11">
							<input type="file" class="form-control" name="medium_banner">
						</div>
						</div><?php
					}
					else
					{
						?><input type="file" class="form-control" name="medium_banner"><?php
					}
					?>
				</div>

				<div class="form-group featured-image">
					<label>Category Gallery1</label>
					<?php
					$category_gallery1 = get_media_path($category->category_gallery1);
					if(!empty($category_gallery1))
					{
						?><div class="row">
						<div class="col-sm-1">
							<img src="<?=$category_gallery1?>" width="33" height="33">
						</div>
						<div class="col-sm-11">
							<input type="file" class="form-control" name="category_gallery1">
						</div>
						</div><?php
					}
					else
					{
						?><input type="file" class="form-control" name="category_gallery1"><?php
					}
					?>
				</div>

				<div class="form-group featured-image">
					<label>Category Gallery2</label>
					<?php
					$category_gallery2 = get_media_path($category->category_gallery2);
					if(!empty($category_gallery2))
					{
						?><div class="row">
						<div class="col-sm-1">
							<img src="<?=$category_gallery2?>" width="33" height="33">
						</div>
						<div class="col-sm-11">
							<input type="file" class="form-control" name="category_gallery2">
						</div>
						</div><?php
					}
					else
					{
						?><input type="file" class="form-control" name="category_gallery2"><?php
					}
					?>
				</div>

				<div class="form-group featured-image">
					<label>Category Gallery3</label>
					<?php
					$category_gallery3 = get_media_path($category->category_gallery3);
					if(!empty($category_gallery3))
					{
						?><div class="row">
						<div class="col-sm-1">
							<img src="<?=$category_gallery3?>" width="33" height="33">
						</div>
						<div class="col-sm-11">
							<input type="file" class="form-control" name="category_gallery3">
						</div>
						</div><?php
					}
					else
					{
						?><input type="file" class="form-control" name="category_gallery3"><?php
					}
					?>
				</div>

				<div class="form-group <?=form_error('target_url1') ? 'has-error' : ''?>">
					<label for="target_url1">Gallery Target URL 01</label>
					<input type="text" class="form-control" name="target_url1" value="<?=set_value('target_url1') ? set_value('target_url1') : isset($category->target_url1) ? $category->target_url1 : NULL?>">
				</div>

				<div class="form-group <?=form_error('target_url2') ? 'has-error' : ''?>">
					<label for="target_url2">Gallery Target URL 02</label>
					<input type="text" class="form-control" name="target_url2" value="<?=set_value('target_url2') ? set_value('target_url2') : isset($category->target_url2) ? $category->target_url2 : NULL?>">
				</div>

				<div class="form-group <?=form_error('target_url3') ? 'has-error' : ''?>">
					<label for="target_url3">Gallery Target URL 03</label>
					<input type="text" class="form-control" name="target_url3" value="<?=set_value('target_url3') ? set_value('target_url3') : isset($category->target_url3) ? $category->target_url3 : NULL?>">
				</div>

				<div class="form-group <?=form_error('rank_order') ? 'has-error' : ''?>">
					<label for="rank_order">Rank Order</label>
					<input type="text" class="form-control" name="rank_order" value="<?=set_value('rank_order') ? set_value('rank_order') : isset($category->rank_order) ? $category->rank_order : NULL?>">
				</div>

				<div class="form-group">
					<div class="checkbox">
						<label><input type="checkbox" name="top_menu" value="1" <?=($category->top_menu==1) ? 'checked' : null;?>> Checked as Top Menu</label>
					</div>
				</div>

				<div class="box box-primary">
					<div class="box-body">
						<div class="form-group <?=form_error('seo_title') ? 'has-error' : ''?>">
							<label for="seo_title">SEO Title</label>
							<input type="text" class="form-control" name="seo_title" id="seo_title" value="<?php if(set_value('seo_title')){ echo set_value('seo_title'); }else{ echo $category->seo_title; } ?>">
						</div>

						<div class="form-group <?=form_error('seo_meta_title') ? 'has-error' : ''?>">
							<label for="seo_meta_title">SEO Meta Title</label>
							<input type="text" class="form-control" name="seo_meta_title" id="seo_meta_title" value="<?php if(set_value('seo_meta_title')){ echo set_value('seo_meta_title'); }else{ echo $category->seo_meta_title; } ?>">
						</div>

						<div class="form-group <?=form_error('seo_keywords') ? 'has-error' : ''?>">
							<label for="seo_keywords">SEO Keywords</label>
							<input type="text" class="form-control" name="seo_keywords" id="seo_keywords" value="<?php if(set_value('seo_keywords')){ echo set_value('seo_keywords'); }else{ echo $category->seo_keywords; } ?>">
						</div>

						<div class="form-group <?=form_error('seo_content') ? 'has-error' : ''?>">
							<label for="seo_content">SEO Content</label>
							<textarea class="form-control" rows="5" name="seo_content" id="seo_content"><?php if(set_value('seo_content')){ echo set_value('seo_content'); }else{ echo $category->seo_content; } ?></textarea>
						</div>

						<div class="form-group <?=form_error('seo_meta_content') ? 'has-error' : ''?>">
							<label for="seo_meta_content">SEO Meta Content</label>
							<textarea class="form-control" rows="5" name="seo_meta_content" id="seo_meta_content"><?php if(set_value('seo_meta_content')){ echo set_value('seo_meta_content'); }else{ echo $category->seo_meta_content; } ?></textarea>
						</div>
					</div>
				</div>
			</div>

			<div class="box-footer">
				<input type="hidden" name="category_id" value="<?php echo $category->category_id; ?>">
				<button type="submit" class="btn btn-success pull-right">Update</button>
				<a href="<?php echo base_url();?>category-list" class="btn btn-danger pull-left">Cancel</a>
			</div>
		</form>



	</div>
</div>
<script>



		

		document.forms['teacher'].elements['designation_id'].value="<?php echo $teacher->designation_id;?>";


	</script>













