<div class="col-md-offset-0 col-md-12">

<div class="box box-success">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo $title; ?></h3>


	</div>
	<div class="box-body">

		


		<form action="<?php echo base_url()?>product-update"  name="proudctUpdate" method="post" enctype="multipart/form-data" >
			<div class="box-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="box box-primary" style="border: 2px solid #ddd;" >
							<div class="box-header" style="background-color: #ddd;" >
								<h3 class="box-title">General Info.</h3>
							</div>
							<div class="box-body">
								<div class="form-group  ">
									<label for="product_title">Title<span class="required">*</span></label>
									<input type="text" class="form-control the_title" name="product_title" id="product_title" value="<?php if(isset($product)) : echo  $product->product_title;endif ; ?>">
									<input type="hidden" class="form-control the_title" name="product_id" id="product_title" value="<?php if(isset($product)) : echo  $product->product_id;endif ; ?>">
								</div>

								<div class="form-group ">
									<label for="product_name">Permalink<span class="required">*</span></label>
									<input type="text" class="form-control the_name" name="product_name" id="product_name" value="<?php if(isset($product)) : echo  $product->product_name;endif ; ?>">
									<p id="produtctError"></p>
								</div>

								<div class="form-group">
									<label for="sku">Product Code</label>
									<input type="text" class="form-control" name="sku" id="sku" value="<?php if(isset($product)){ echo $product->sku;} ?>">
								</div>

								<div  hidden class="form-group ">
									<label for="purchase_price">Purchase Price<span class="required">*</span></label>
									<input type="text" class="form-control" name="purchase_price" id="purchase_price" value="<?php if(isset($product)) { echo $product->purchase_price;} ?>">
								</div>

								<div class="form-group ">
									<label for="sell_price">Regular Price<span class="required">*</span></label>
									<input type="text" class="form-control" name="sell_price" id="sell_price" value="<?php if(isset($product)){ echo $product->product_price;} ?>">
								</div>
								<div class="form-group ">
									<label for="discount_price"> Discount Price</label>
									<input type="text" class="form-control" name="discount_price" id="discount_price" value="<?php if(isset($product)) { echo $product->discount_price ; } ?>">
								</div>
								<div class="col-sm-6">
									<div class="form-group <?=form_error('discount_from') ? 'has-error' : ''?>">
										<label for="discount_from">Discount From</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>

											<input type="text" class="form-control withoutFixedDate " name="discount_date_from" id="discount_from" value="<?php echo  date('d-m-Y',strtotime($product->discount_date_from)) ; ?>">


										</div>
									</div>
								</div>
								<div class="col-sm-6 ">
									<div class="form-group <?=form_error('discount_to') ? 'has-error' : ''?>">
										<label for="discount_to">Discount To</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>

											<input type="text" class="form-control withoutFixedDate " name="discount_date_to" id="discount_from" value="<?php echo  date('d-m-Y',strtotime($product->discount_date_to)) ; ?>">

										</div>
									</div>
								</div>

								<div class="form-group <?= form_error('sell_price') ? 'has-error' : '' ?>">
									<label for="discount_price"> Delevary Charge</label>

								</div>


								<div class="col-sm-6">
									<div
										class="form-group <?= form_error('discount_from') ? 'has-error' : '' ?>">
										<label for="discount_from">In Side Dhaka</label>
										<input  type="text" class="form-control the_title"
											   name="delever_charge_in_dhaka" id="product_title"
											   value="<?php echo $product->delever_charge_in_dhaka; ?>">
									</div>
								</div>
								<div class="col-sm-6 ">
									<div
										class="form-group <?= form_error('discount_to') ? 'has-error' : '' ?>">
										<label for="discount_to">Out Side Dhaka</label>
										<input  type="text" class="form-control the_title"
											   name="delever_charge_out_dhaka" id="product_title"
											   value="<?php if(isset($product)){ echo $product->delever_charge_out_dhaka; }?>">
									</div>
								</div>
								<div hidden class="col-sm-6">
									<label for="discount_type">Discount Type</label>

									<select id="discount_type"  name="discount_type" class="form-control">

										<option value="percent">Percent</option>
									</select>
								</div>

								<div  hidden class="form-group <?=form_error('stock_qty') ? 'has-error' : ''?>">
									<label for="stock_qty">Stock Qty.</label>
									<input type="text" class="form-control" name="stock_qty" id="stock_qty" value="<?php if(isset($product)) { echo $product->product_stock;}?>">
								</div>
								<div   class="form-group "><label for="product_availability">Product
										Availability</label> <select name="product_availability"
																	 class="form-control">
										<option value="In stock">In stock</option>
										<option value="Out of stock">Out of stock</option>
									</select></div>
								<div class="form-group "><label for="product_availability">Product
										Status</label> <select name="status"
															   class="form-control">
										<option value="1">Published</option>
										<option value="0">Unpublished</option>
									</select></div>


								<div class="form-group">
									<label for="product_type">Product Location</label>
									<select name="product_type" class="form-control">
										<option value="general">General</option>
										<option value="hotsell">Top Category  Product</option>
										<option value="home">Home</option>

									</select>

								</div>

								<div  class="form-group">
									<label for="product_video">Youtube Video Link</label>
									<input type="text" class="form-control" name="product_video" id="product_video" value="<?php if(isset($product)){ echo $product->product_video;} ?>">
								</div>



							</div>
						</div>


					</div>


					<div class="col-sm-6" >
						<div class="box box-primary" style="border: 2px solid #ddd;" >
							<div class="box-header" style="background-color: #ddd;" >
								<h3 class="box-title">Image and Gallary</h3>
							</div>
							<div class="box-body">
								<?php
								$featured_image = get_product_meta($product->product_id, 'featured_image');
								$featured_image = get_media_path($featured_image);

								$gallery_image = explode(",", get_product_meta($product->product_id, 'gallery_image'));
								if(count($gallery_image)>0)
								{
									foreach($gallery_image as $gallery_id)
									{
										$gallery[] = get_media_path($gallery_id);
										$galleryId[] = $gallery_id;

									}
								}
								?>

								<div class="form-group featured-image">
									<label>Featured Image<span class="required">*</span></label>
									<div class="row">
										<div class="col-sm-1">
											<img src="<?=$featured_image?>" width="33" height="33">
										</div>
										<div class="col-sm-11">
											<input type="file" class="form-control" name="featured_image">
											<input type="text" class="form-control" name="featured_image_link"/>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label>Product Gallary</label>
									<div class="row">
										<?php
										if(isset($gallery[0]))
										{
											?><div class="col-sm-1">
											<img src="<?=$gallery[0]?>" width="33" height="33">
											<a href="javascript:void(0)" class="remove_gallery_img" id="<?=$galleryId[0]?>" >Remove</a>
											</div>
											<div class="col-sm-11">
												<input type="file" class="form-control" name="product_image1">
												<input type="text" class="form-control" name="product_image1_link"/>
											</div><?php
										}
										else
										{
											?><div class="col-sm-12">
											<input type="file" class="form-control" name="product_image1">
											<input type="text" class="form-control" name="product_image1_link"/>
										</div><?php
										}
										?>
									</div>
									<br>
									<div class="row">
										<?php
										if(isset($gallery[1]))
										{
											?><div class="col-sm-1">
											<img src="<?=$gallery[1]?>" width="33" height="33">
											<a href="javascript:void(0)" class="remove_gallery_img" id="<?=$galleryId[1]?>">Remove</a>
											</div>
											<div class="col-sm-11">
												<input type="file" class="form-control" name="product_image2">
												<input type="text" class="form-control" name="product_image2_link"/>
											</div><?php
										}
										else
										{
											?><div class="col-sm-12">
											<input type="file" class="form-control" name="product_image2">
											<input type="text" class="form-control" name="product_image2_link"/>
										</div><?php
										}
										?>
									</div>
									<br>
									<div class="row">
										<?php
										if(isset($gallery[2]))
										{
											?><div class="col-sm-1">
											<img src="<?=$gallery[2]?>" width="33" height="33">
											<a href="javascript:void(0)" class="remove_gallery_img" id="<?=$galleryId[2]?>">Remove</a>
											</div>
											<div class="col-sm-11">
												<input type="file" class="form-control" name="product_image3">
												<input type="text" class="form-control" name="product_image3_link"/>
											</div><?php
										}
										else
										{
											?><div class="col-sm-12">
											<input type="file" class="form-control" name="product_image3">
											<input type="text" class="form-control" name="product_image3_link"/>
										</div><?php
										}
										?>
									</div>


									<div class="row">
										<?php
										if(isset($gallery[3]))
										{
											?><div class="col-sm-1">
											<img src="<?=$gallery[3]?>" width="33" height="33">
											<a href="javascript:void(0)" class="remove_gallery_img" id="<?=$galleryId[3]?>">Remove</a>
											</div>
											<div class="col-sm-11">
												<input type="file" class="form-control" name="product_image4">
												<input type="text" class="form-control" name="product_image4_link"/>
											</div><?php
										}
										else
										{
											?><div class="col-sm-12">
											<input type="file" class="form-control" name="product_image4">
											<input type="text" class="form-control" name="product_image4_link"/>
										</div><?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>



			</div>

			<div class="" >

				<div class="box-body">

					<div  class="row">
						<div  class="col-md-3">
							<div class="box box-primary" style="border: 2px solid #ddd;" >
								<div class="box-header" style="background-color: #ddd;" >
									<h3 class="box-title">product size</h3>
								</div>
								<div class="box-body" style="height: 300px;overflow: scroll">
									<div class="form-group categories checkbox">

										<ul>
											<?php
											$result = $this->db->query("SELECT * FROM  product_size")->result();



											if(isset($result))
											{
												foreach($result as $row)
												{
													?>
													<li>
														<label><input
																<?php $size=$product->product_of_size;
																$arraySize=explode(',',$size); foreach ($arraySize as $key=>$productSize) {
																	if ($productSize == $row->name) {
																		echo 'checked';
																	} else {
																		echo '';
																	}
																}
																?>

																type="checkbox" name="product_size[]" value="<?php echo $row->name;?>" ><?php echo $row->name;?></label>


													</li>


													<?php
												}

											}
											?>
										</ul>
									</div>
								</div>
							</div>


						</div>




						<div  class="col-md-3">



							<div class="box box-primary" style="border: 2px solid #ddd;" >
								<div class="box-header" style="background-color: #ddd;" >
									<h3 class="box-title">Product Color</h3>
								</div>
								<div class="box-body" style="height: 300px;overflow: scroll">
									<div class="form-group categories checkbox">

										<ul>
											<?php
											$result = $this->db->query("SELECT * FROM  product_color")->result();

											if(isset($result))
											{
												foreach($result as $row)
												{
													?>
													<li>
														<label><input
																<?php $color=$product->product_color;
																$arrayColor=explode(',',$color);
																foreach ($arrayColor as $key=>$productSize) {
																	if ($productSize == $row->product_color_name) {
																		echo 'checked';
																	} else {
																		echo '';
																	}
																}
																?>

																type="checkbox" name="product_color[]" value="<?php echo $row->product_color_name;?>" ><?php echo $row->product_color_name;?></label>

													</li>


													<?php
												}

											}
											?>
										</ul>
									</div>
								</div>
							</div>



						</div>

						<div class="col-md-6">
							<div class="box box-primary" style="border: 2px solid #ddd;" >
								<div class="box-header" style="background-color: #ddd;" >
									<h3 class="box-title">Categories</h3>
								</div>
								<div class="box-body" style="height: 300px;overflow: scroll">
									<div class="form-group categories checkbox">
										<?php
										$category = array('categories' => array(),'parent_cats' => array());

										$result = get_result("SELECT * FROM `category`");

										if(isset($result))
										{
											foreach($result as $row)
											{
												$category['categories'][$row->category_id] = $row;

												$category['parent_cats'][$row->parent_id][] = $row->category_id;
											}

											echo nested_category_checkbox_list(0, $category, $product_terms);
										}
										?>
									</div>
								</div>
							</div>

						</div>


					</div>

				</div>
			</div>


			<!--
			<div class="box box-primary" style="border: 2px solid #ddd;" >
				<div class="box-header" style="background-color: #ddd;" >
					<h3 class="box-title">Discount</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<label for="discount_price">Discount Amount</label>
										<input type="text" class="form-control" name="discount_price" id="discount_price" value="<?php if(isset($product)) { echo $product->discount_price ; } ?>">
									</div>
									<div class="col-sm-6">
										<label for="discount_type">Discount Type</label>

										<select id="discount_type"  name="discount_type" class="form-control">

											<option value="percent">Percent</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group <?=form_error('discount_from') ? 'has-error' : ''?>">
										<label for="discount_from">Discount From</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<?php echo form_input(array('name'=>'discount_from', 'class'=>'form-control pull-right datepicker', 'id'=>'discount_from', 'value'=>set_value('discount_from'))); ?>
										</div>
									</div>
								</div>
								<div class="col-sm-6 ">
									<div class="form-group <?=form_error('discount_to') ? 'has-error' : ''?>">
										<label for="discount_to">Discount To</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<?php echo form_input(array('name'=>'discount_to', 'class'=>'form-control pull-right datepicker', 'id'=>'discount_to', 'value'=>set_value('discount_to'))); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			-->
			
				<div class="box box-primary" style="border: 2px solid #ddd;" >
				<div class="box-header" style="background-color: #ddd;" >
					<h3 class="box-title">Quick Overview
					</h3>
				</div>
				<div class="box-body">
					<div class="form-group ">
						<textarea  class="form-control  " rows="10" name="product_summary" id="product_summary"><?php if(isset($product)) : echo  $product->product_summary;endif ; ?> </textarea>
					</div>
				</div>
			</div>

			<div class="box box-primary" style="border: 2px solid #ddd;" >
				<div class="box-header" style="background-color: #ddd;" >
					<h3 class="box-title">Description</h3>
				</div>
				<div class="box-body">
					<div class="form-group ">
						<textarea     id="editor1" class="form-control " rows="15" name="product_description" id="product_description"><?php if(isset($product)) : echo  $product->product_description;endif ; ?></textarea>
					</div>
				</div>
			</div>
			
				<div class="box box-primary"  style="border:2px solid #ddd" id="specification">
				<div class="box-header" style="background-color: #ddd"
				>
					<h3 class="box-title">Specifications</h3>
				</div>
				<div class="box-body">
					<div class="ajax_content">
						<?php

						$i = 1;

						if(!empty($specifications))
						{
							foreach($specifications as $specification)
							{
								?><div class="form-group step_box relative">
								<div class="row row5">
									<div class="col-sm-6">
										<input type="text" class="form-control" name="specifications[<?php echo $i; ?>][key]" placeholder="Keyword" value="<?php echo $specification->key; ?>">
									</div>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="specifications[<?php echo $i; ?>][value]" placeholder="Value" value="<?php echo $specification->value; ?>">
									</div>
								</div>
								<div class="step_closer">x</div>
								</div><?php

								$i++;
							}
						}
						else
						{
							?><div class="form-group step_box relative">
							<div class="row row5">
								<div class="col-sm-6">
									<input type="text" class="form-control" name="specifications[1][key]" placeholder="Keyword">
								</div>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="specifications[1][value]" placeholder="Value">
								</div>
							</div>

						</div><?php
						}
						?>
					</div>
					<input type="hidden" name="last_specification_no" class="last_specification_no" value="<?php echo $i; ?>">
					<a class="add_specification btn btn-success  pull-right" href="javascript:void(0)">Add Specification</a>
				</div>
			</div>

		

		

			<div class="box box-primary" style="border: 2px solid #ddd;" >
				<div class="box-header" style="background-color: #ddd;" >
					<h3 class="box-title">Terms &amp; Conditions</h3>
				</div>
				<div class="box-body">
					<div class="form-group ">
						<textarea class="form-control textarea " rows="5" name="product_terms" id="product_terms"><?php if(isset($product)) : echo  $product->product_terms;endif ; ?></textarea>
					</div>
				</div>
			</div>


			<div class="box box-primary" style="border: 2px solid #ddd;" >
				<div class="box-header" style="background-color: #ddd;" >
					<h3 class="box-title">SEO Options</h3>
				</div>
				<div class="box-body">
					<div class="form-group ">
						<label for="seo_title"> Title</label>
						<input type="text" class="form-control" name="seo_title" id="seo_title" value="<?php if(isset($product)) { echo $product->seo_title  ; } ?>">
					</div>



					<div class="form-group  ">
						<label for="seo_content">Meta Description</label>
						<textarea class="form-control" rows="5" name="seo_content" id="seo_content"><?php if(isset($product)){ echo $product->seo_content ;} ?></textarea>
					</div>
					<div class="form-group  ">
						<label for="seo_keywords">Meta Keywords</label>
						<input type="text"  rows="1" class="form-control" name="seo_keywords" id="seo_keywords" value="<?php if(isset($product)) { echo $product->seo_keywords ; } ?>">
					</div>
				</div>
			</div>
	</div>


	<div class="box-footer">
		<input type="submit" class="btn btn-success pull-left" value="Update"/>
<!--		<a class="btn btn-danger pull-left " href="--><?php //echo base_url();?><!--product-list">Cancel</a>-->

	</div>
	</form>

</div>
</div>


<script type="text/javascript">
	/*### add more specification ###*/
	jQuery('#specification .add_specification').on('click', function()
	{
		var last_specification_no = parseInt(jQuery('.last_specification_no').val());
		var next_specification_no = last_specification_no + 1;

		jQuery('#specification .ajax_content').append('<div class="form-group step_box relative"><div class="row row5"><div class="col-sm-6"><input type="text" class="form-control" name="specifications['+next_specification_no+'][key]" placeholder="Keyword"></div><div class="col-sm-6"><input type="text" class="form-control" name="specifications['+next_specification_no+'][value]" placeholder="Value"></div></div><div class="step_closer">x</div></div>');

		jQuery('.last_specification_no').val(next_specification_no)

		return false;
	});

	/*# close lesson step #*/
	jQuery('body').on('click', '.step_closer', function(){
		jQuery(this).parents('.step_box').remove();
	});
</script>
<script>
		document.forms['proudctUpdate'].elements['product_type'].value="<?php echo $product->product_type;?>";
		document.forms['proudctUpdate'].elements['status'].value="<?php echo $product->status;?>";
		document.forms['proudctUpdate'].elements['discount_type'].value="<?php echo $product->discount_type;?>";
		document.forms['proudctUpdate'].elements['product_availability'].value="<?php echo $product->product_availability;?>";

		$('.remove_gallery_img').on('click',function () {
			var media_id=this.id;
			var url      = window.location.href;     // Returns full URL (https://example.com/path/example.html)
			//alert(url)
			$.ajax({
				type :'post',
				url:'<?php echo base_url()?>product/ProductController/geleryImageDelete',
				data:{media_id:media_id},
				success: function (data) {
					alert(data);
					window.location=url;
				}
			});
		});

</script>




<script>
	$(document).ready(function () {
		$("#product_title").on( 'input click', function () {
			var text=$("#product_title").val();
			var word= text.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
			$("#product_name").val(word);
			$.ajax({
				data:{url:word},
				type:"POST",
				url:'<?php echo base_url()?>product/ProductController/urlCheck',
				success:function (result) {
					$('#produtctError').html(result);
					var str2="es";
					var word=$("#product_name").val(word);
					if(result){
						var text=$("#product_title").val();
						var word= text.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
						var word = word.concat(str2);
						$("#product_name").val(word);

					} else {
						var text=$("#product_title").val();
						var word= text.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
						$("#product_name").val(word);
					}
				}
			});
		});
	});
</script>



















