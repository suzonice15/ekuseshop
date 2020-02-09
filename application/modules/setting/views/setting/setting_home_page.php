<div class="col-md-offset-0 col-md-12">

<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $title; ?></h3>


	</div>
	<div class="box-body">



		<form method="POST" action="<?=base_url('setting-home')?>" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group <?=form_error('home_cat_section') ? 'has-error' : ''?>">
									<label for="home_cat_section">Home Category Section</label>
									<input type="text" class="form-control" name="home_cat_section" id="home_cat_section" value="<?=get_option('home_cat_section')?>">
								</div>

								<div class="form-group <?=form_error('home_cat_section') ? 'has-error' : ''?>">
									<label for="home_cat_section">Home Top Categories This Week Section</label>
									<input type="text" class="form-control" name="top_weekly_category" id="home_cat_section" value="<?=get_option('top_weekly_category')?>">
								</div>


								<div class="box box-primary" style="border: 2px solid #ddd;" >
									<div class="box-header" style="background-color: #ddd;" >
										<h3 class="box-title">SEO Options
										</h3>
									</div>
									<div class="box-body">
										<div class="form-group <?=form_error('home_seo_title') ? 'has-error' : ''?>">
											<label for="home_seo_title">Title</label>
											<input type="text" class="form-control" name="home_seo_title" id="home_seo_title" value="<?=get_option('home_seo_title')?>">
										</div>


										<div class="form-group <?=form_error('home_seo_content') ? 'has-error' : ''?>">
											<label for="home_seo_content">Meta Descripiton</label>
											<textarea class="form-control" rows="5" name="home_seo_content"><?=get_option('home_seo_content')?></textarea>
										</div>

										<div class="form-group <?=form_error('home_seo_keywords') ? 'has-error' : ''?>">
											<label for="home_seo_keywords">Meta Keywords</label>
											<input type="text" class="form-control" name="home_seo_keywords" id="home_seo_keywords" value="<?=get_option('home_seo_keywords')?>">
										</div>

										<div  hidden class="form-group <?=form_error('home_about_title') ? 'has-error' : ''?>">
											<label for="home_about_title">Home Page About Title</label>
											<input type="text" class="form-control" name="home_about_title" id="home_about_title" value="<?=get_option('home_about_title')?>">
										</div>

										<div class="form-group <?=form_error('home_about_content') ? 'has-error' : ''?>">
											<label for="home_about_content"> Content</label>
											<textarea class="form-control" rows="5" name="home_about_content"><?=get_option('home_about_content')?></textarea>
										</div>
									</div>
								</div>


							</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-success pull-right">Update</button>
							</div>
						</form>
				



	</div>
</div>







