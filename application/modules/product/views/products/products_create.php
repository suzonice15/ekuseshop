<div class="col-md-12">

	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title"><?php echo $title; ?></h3>


		</div>
		<div class="box-body">
			<div class="box-body">
				<form method="POST" action="<?php echo base_url() ?>product-save" enctype="multipart/form-data">
					<div class="box-body">
						<div class="row">
							<div class="col-sm-6">
								<div class="box box-primary" style="border: 2px solid #ddd;">
									<div class="box-header" style="background-color: #bdbdbf;">
										<h3 class="box-title">Product Information</h3>
									</div>
									<div class="box-body">
										<div class="form-group <?= form_error('product_title') ? 'has-error' : '' ?>">
											<label for="product_title">Product Title<span
													class="required">*</span></label>
											<input required type="text" class="form-control the_title"
												   name="product_title" id="product_title"
												   value="<?php echo set_value('product_title'); ?>">
										</div>

										<div class="form-group <?= form_error('product_name') ? 'has-error' : '' ?>">
											<label for="product_name">Permalink<span class="required">*</span></label>
											<input required type="text" class="form-control the_name"
												   name="product_name" id="product_name"
												   value="<?php echo set_value('product_name'); ?>">
											<p id="produtctError"></p>
										</div>

										<div class="form-group <?= form_error('sku') ? 'has-error' : '' ?>">
											<label for="sku">Product Code(sku)<span class="required">*</span></label>
											<input required type="text" class="form-control" name="sku" id="sku"
												   value="<?php echo $random_number; ?>">
											<span class="text-danger" id="sku_error"></span>
										</div>

										<div hidden
											 class="form-group <?= form_error('purchase_price') ? 'has-error' : '' ?>">
											<label for="purchase_price">Regular Price<span
													class="required">*</span></label>
											<input type="text" class="form-control" name="purchase_price"
												   id="purchase_price"
												   value="<?php echo set_value('purchase_price'); ?>">
										</div>

										<div class="form-group <?= form_error('sell_price') ? 'has-error' : '' ?>">
											<label for="sell_price">Regular Price<span class="required">*</span></label>
											<input required type="text" class="form-control" name="sell_price"
												   id="sell_price" value="<?php echo set_value('sell_price'); ?>">
										</div>


										<div class="form-group <?= form_error('sell_price') ? 'has-error' : '' ?>">
											<label for="discount_price"> Discount Price</label>
											<input type="text" class="form-control" name="discount_price"
												   id="discount_price"
												   value="<?php echo set_value('discount_price'); ?>">
										</div>


										<div class="col-sm-6">
											<div
												class="form-group <?= form_error('discount_from') ? 'has-error' : '' ?>">
												<label for="discount_from">Discount From</label>
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<?php echo form_input(array('name' => 'discount_from', 'class' => 'form-control pull-right datepicker ', 'id' => 'discount_from', 'value' => set_value('discount_from'))); ?>
												</div>
											</div>
										</div>
										
										<div class="col-sm-6 ">
											<div
												class="form-group <?= form_error('discount_to') ? 'has-error' : '' ?>">
												<label for="discount_to">Discount To</label>
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<?php echo form_input(array('name' => 'discount_to', 'class' => 'form-control pull-right withoutFixedDate', 'id' => 'discount_to', 'value' => set_value('discount_to'))); ?>
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
													   value="<?=get_option('shipping_charge_in_dhaka')?>">
											</div>
										</div>
										<div class="col-sm-6 ">
											<div
												class="form-group <?= form_error('discount_to') ? 'has-error' : '' ?>">
												<label for="discount_to">Out Side Dhaka</label>
												<input  type="text" class="form-control the_title"
													   name="delever_charge_out_dhaka" id="product_title"
													   value="<?=get_option('shipping_charge_out_of_dhaka')?>">
											</div>
										</div>

										<div hidden class="col-sm-6">
											<label for="discount_type">Discount Type</label>
											<?php

											$discount_types['percent'] = 'Percent';

											$selected_type = set_value('discount_type') ? set_value('discount_type') : null;

											echo form_dropdown('discount_type', $discount_types, $selected_type, array('class' => 'form-control'));
											?>
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
					<div hidden							 class="form-group <?= form_error('stock_qty') ? 'has-error' : '' ?>">
											<label for="stock_qty">Stock Qty.</label>
											<input type="text" class="form-control" name="stock_qty" id="stock_qty"
												   value="<?php echo set_value('stock_qty'); ?>">
										</div>


										<div class="form-group <?= form_error('product_type') ? 'has-error' : '' ?>">
											<label for="product_type">Product Location</label>
											<?php echo form_dropdown('product_type', array('general' => 'General', 'hotsell' => 'Top Category  Product', 'home' => 'Home'), set_value('product_type'), array('class' => 'form-control')); ?>
										</div>

										<div
											 class="form-group <?= form_error('product_video') ? 'has-error' : '' ?>">
											<label  for="product_video">Youtube Video Link</label>
											<input type="text" class="form-control" name="product_video"
												   id="product_video" value="<?php echo set_value('product_video'); ?>">
										</div>


										<div hidden
											 class="form-group <?= form_error('product_summary') ? 'has-error' : '' ?>">
											<label for="product_summary">Quick Overview
											</label>
											<textarea class="form-control" rows="10" name="product_summary"
													  id="product_summary"><?php echo set_value('product_summary'); ?>  </textarea>
										</div>
									</div>
								</div>
							</div>

							<div class="col-sm-6">

								<div class="box box-primary" style="border: 2px solid #ddd;height: 550px">
									<div class="box-header" style="background-color: #bdbdbf;">

										<h3 class="box-title">Image and Gallary</h3>
									</div>
									<div class="box-body">

										<div class="form-group featured-image">
											<label>Featured Image<span class="required">* Size(800*800)</span></label>
											<input  type="file" class="form-control" name="featured_image"/>
<br>
											<input type="text"  placeholder="Enter image Permalink" class="form-control" name="featured_image_link" value="<?php echo set_value('featured_image_link'); ?>"/>
										</div>
										</div>

										<div class="form-group">
											<label>Product Gallary</label>
											<div class="row">
												<div class="col-sm-12">
													<input type="file" class="form-control" name="product_image1"/>
													<br>
													<input placeholder="Enter image Permalink" type="text" class="form-control" name="product_image1_link" value="<?php echo set_value('product_image1_link'); ?>"/>
												</div>
												</div>
											</div>
											<br/>
											<div class="row">
												<div class="col-sm-12">
													<input type="file" class="form-control" name="product_image2"/>
													<br>
													<input placeholder="Enter image Permalink" type="text" class="form-control" name="product_image2_link" value="">
												</div>
												</div>


											<div class="row">
												<div class="col-sm-12">
													<input type="file" class="form-control" name="product_image3"/>
													<br>
													<input placeholder="Enter image Permalink" type="text" class="form-control" name="product_image3_link" value="<?php echo set_value('product_image3_link'); ?>"/>
												</div>

												</div>
											</div>
											<div   class="row">
												<div class="col-sm-12">
													<input type="file" class="form-control" name="product_image4"/>
													<br/>
													<input placeholder="Enter image Permalink" type="text" class="form-control" name="product_image4_link" value="<?php echo set_value('product_image4_link'); ?>"/>

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>


						</div>


						<div class="">

							<div class="box-body">

								<div class="row">
									<div class="col-md-3">
										<div class="box box-primary" style="border: 2px solid #ddd;">
											<div class="box-header" style="background-color: #bdbdbf;">

												<h3 class="box-title">product size</h3>
											</div>
											<div class="box-body" style="height: 300px;overflow: scroll">
												<div class="form-group categories checkbox">

													<ul>
														<?php
														$result = $this->db->query("SELECT * FROM  product_size")->result();

														if (isset($result)) {
															foreach ($result as $row) {
																?>
																<li>
																	<label><input type="checkbox" name="product_size[]"
																				  value="<?php echo $row->name; ?>"><?php echo $row->name; ?>
																	</label>

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


									<div class="col-md-3">


										<div class="box box-primary" style="border: 2px solid #ddd;">
											<div class="box-header" style="background-color: #bdbdbf;">

												<h3 class="box-title">Product Color</h3>
											</div>
											<div class="box-body" style="height: 300px;overflow: scroll">
												<div class="form-group categories checkbox">

													<ul>
														<?php
														$result = $this->db->query("SELECT * FROM  product_color")->result();

														if (isset($result)) {
															foreach ($result as $row) {
																?>
																<li>
																	<label><input type="checkbox" name="product_color[]"
																				  value="<?php echo $row->product_color_name; ?>"><?php echo $row->product_color_name; ?>
																	</label>

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
										<div class="box box-primary" style="border: 2px solid #ddd;">
											<div class="box-header" style="background-color: #bdbdbf;">

												<h3 class="box-title">Categories<span class="required">*</span></h3>
											</div>
											<div class="box-body" style="height: 300px;overflow: scroll">
												<div
													class="form-group categories checkbox <?= form_error('categories') ? 'has-error' : '' ?>">
													<?php
													$category = array('categories' => array(), 'parent_cats' => array());

													$result = get_result("SELECT * FROM `category`");

													if (isset($result)) {
														foreach ($result as $row) {
															$category['categories'][$row->category_id] = $row;

															$category['parent_cats'][$row->parent_id][] = $row->category_id;
														}

														echo nested_category_checkbox_list(0, $category, array());
													}
													?>
												</div>
											</div>
										</div>

									</div>


								</div>

							</div>
						</div>

						
					</div>
						<div class="box box-primary" style="border: 2px solid #ddd;" >
						<div class="box-header" style="background-color: #ddd;" >
							<h3 class="box-title">Quick Overview
							</h3>
						</div>
						<div class="box-body">
							<div class="form-group ">
								<textarea class="form-control" rows="3" name="product_summary" id="product_summary"> </textarea>
							</div>
						</div>
					</div>
					<div class="box box-primary" style="border: 2px solid #ddd;">
						<div class="box-header" style="background-color: #bdbdbf;">

							<h3 class="box-title">Description</h3>
						</div>
						<div class="box-body">
							<div class="form-group <?= form_error('product_description') ? 'has-error' : '' ?>">
									<textarea  id="editor1" class="form-control" rows="10" name="product_description"
											  id="product_description"><?php echo set_value('product_description'); ?></textarea>
							</div>
						</div>
					</div>
					
					<div class="box box-primary" id="specification" style="border:1px solid #ddd ;margin-bottom: 39px;">
							<div class="box-header" style="background-color: #ddd">
								<h3 class="box-title">Specifications</h3>
							</div>
							<div class="box-body">
								<div class="ajax_content">

									<div class="row row5">
										<div class="col-sm-6">
											<input type="text" class="form-control" name="specifications[]"
												   placeholder="Keyword">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="value[]"
												   placeholder="Value">
										</div>
									</div>
									<div class="row row5">
										<div class="col-sm-6">
											<input type="text" class="form-control" name="specifications[]"
												   placeholder="Keyword">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="value[]"
												   placeholder="Value">
										</div>
									</div>
									<div class="row row5">
										<div class="col-sm-6">
											<input type="text" class="form-control" name="specifications[]"
												   placeholder="Keyword">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="value[]"
												   placeholder="Value">
										</div>
									</div>
									<div class="row row5">
										<div class="col-sm-6">
											<input type="text" class="form-control" name="specifications[]"
												   placeholder="Keyword">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="value[]"
												   placeholder="Value">
										</div>
									</div>
									<div class="row row5">
										<div class="col-sm-6">
											<input type="text" class="form-control" name="specifications[]"
												   placeholder="Keyword">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="value[]"
												   placeholder="Value">
										</div>
									</div>
									<div class="row row5">
										<div class="col-sm-6">
											<input type="text" class="form-control" name="specifications[]"
												   placeholder="Keyword">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="value[]"
												   placeholder="Value">
										</div>
									</div>
									<div class="row row5">
										<div class="col-sm-6">
											<input type="text" class="form-control" name="specifications[]"
												   placeholder="Keyword">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="value[]"
												   placeholder="Value">
										</div>
									</div>
									<div class="row row5">
										<div class="col-sm-6">
											<input type="text" class="form-control" name="specifications[]"
												   placeholder="Keyword">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="value[]"
												   placeholder="Value">
										</div>
									</div>
									<div class="row row5">
										<div class="col-sm-6">
											<input type="text" class="form-control" name="specifications[]"
												   placeholder="Keyword">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="value[]"
												   placeholder="Value">
										</div>
									</div>
									<div class="row row5">
										<div class="col-sm-6">
											<input type="text" class="form-control" name="specifications[]"
												   placeholder="Keyword">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="value[]"
												   placeholder="Value">
										</div>
									</div>
									<div class="row row5">
										<div class="col-sm-6">
											<input type="text" class="form-control" name="specifications[]"
												   placeholder="Keyword">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="value[]"
												   placeholder="Value">
										</div>
									</div>
									<div class="row row5">
										<div class="col-sm-6">
											<input type="text" class="form-control" name="specifications[]"
												   placeholder="Keyword">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="value[]"
												   placeholder="Value">
										</div>
									</div>
									<div class="row row5">
										<div class="col-sm-6">
											<input type="text" class="form-control" name="specifications[]"
												   placeholder="Keyword">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="value[]"
												   placeholder="Value">
										</div>
									</div>
									<div class="row row5">
										<div class="col-sm-6">
											<input type="text" class="form-control" name="specifications[]"
												   placeholder="Keyword">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="value[]"
												   placeholder="Value">
										</div>
									</div>
									<div class="row row5">
										<div class="col-sm-6">
											<input type="text" class="form-control" name="specifications[]"
												   placeholder="Keyword">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="value[]"
												   placeholder="Value">
										</div>
									</div>


									<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[3][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[3][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[4][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[4][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[5][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[5][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!---->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[6][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[6][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[7][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[7][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[8][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[8][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[9][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[9][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[10][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[10][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[11][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[11][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[12][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[12][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[13][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[13][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[14][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[14][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!---->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[15][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[15][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!---->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[16][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[16][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!---->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[17][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[17][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!---->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[18][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[18][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!---->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[19][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[19][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
<!---->
<!--									<div class="row row5">-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[20][key]"-->
<!--												   placeholder="Keyword">-->
<!--										</div>-->
<!--										<div class="col-sm-6">-->
<!--											<input type="text" class="form-control" name="specifications[20][value]"-->
<!--												   placeholder="Value">-->
<!--										</div>-->
<!--									</div>-->
									<!--										<div class="step_closer">x</div>-->
								</div>
							</div>
<!--							<input type="hidden" name="last_specification_no" class="last_specification_no" value="1">-->
<!--							<a class="add_specification btn btn-success pull-right " href="javascript:void(0)">Add-->
<!--								Specification</a>-->
						</div>

				

					<div class="box box-primary" style="border: 2px solid #ddd;">
						<div class="box-header" style="background-color: #bdbdbf;">

							<h3 class="box-title">Terms &amp; Conditions</h3>
						</div>
						<div class="box-body">
							<div class="form-group <?= form_error('product_terms') ? 'has-error' : '' ?>">
									<textarea class="form-control textarea " rows="5" name="product_terms"
											  id="product_terms"><?php echo set_value('product_terms'); ?></textarea>
							</div>
						</div>
					</div>
					<!--
						<div class="box box-primary" style="border: 2px solid #ddd;">
							<div class="box-header" style="background-color: #bdbdbf;">

								<h3 class="box-title">Product Discount</h3>
							</div>
							<div class="box-body">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<div class="row">
												<div class="col-sm-6">
													<label for="discount_price"> Discount Amount</label>
													<input type="text" class="form-control" name="discount_price"
														   id="discount_price"
														   value="<?php echo set_value('discount_price'); ?>">
												</div>
												<div  class="col-sm-6">
													<label for="discount_type">Discount Type</label>
													<?php

					$discount_types['percent'] = 'Percent';

					$selected_type = set_value('discount_type') ? set_value('discount_type') : null;

					echo form_dropdown('discount_type', $discount_types, $selected_type, array('class' => 'form-control'));
					?>
												</div>
											</div>
										</div>
									</div>

									<div class="col-sm-6">
										<div class="row">
											<div class="col-sm-6">
												<div
													class="form-group <?= form_error('discount_from') ? 'has-error' : '' ?>">
													<label for="discount_from">Discount From</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<?php echo form_input(array('name' => 'discount_from', 'class' => 'form-control pull-right datepicker', 'id' => 'discount_from', 'value' => set_value('discount_from'))); ?>
													</div>
												</div>
											</div>
											<div class="col-sm-6 ">
												<div
													class="form-group <?= form_error('discount_to') ? 'has-error' : '' ?>">
													<label for="discount_to">Discount To</label>
													<div class="input-group date">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<?php echo form_input(array('name' => 'discount_to', 'class' => 'form-control pull-right datepicker', 'id' => 'discount_to', 'value' => set_value('discount_to'))); ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>



			-->
					<div class="box box-primary" style="border: 2px solid #ddd;">
						<div class="box-header" style="background-color: #bdbdbf;">

							<h3 class="box-title">SEO Options</h3>
						</div>


						<div class="box-body">
							<div class="form-group <?= form_error('seo_title') ? 'has-error' : '' ?>">
								<label for="seo_title"> Title</label>
								<input type="text" class="form-control" name="seo_title" id="seo_title"
									   value="<?php echo set_value('seo_title'); ?>">
							</div>


							<div class="form-group <?= form_error('seo_content') ? 'has-error' : '' ?>">
								<label for="seo_content">Meta description</label>
								<textarea class="form-control" rows="5" name="seo_content"
										  id="seo_content"><?php echo set_value('seo_content'); ?></textarea>
							</div>

							<div class="form-group <?= form_error('seo_keywords') ? 'has-error' : '' ?>">
								<label for="seo_keywords">Meta Keywords</label>

								<input type="text" class="form-control" name="seo_keywords" id="seo_title"
									   value="<?php echo set_value('seo_keywords'); ?>">


							</div>
						</div>
					</div>
			</div>
			<div class="box-footer">
				<!--						<a href="-->
				<?php //echo base_url() ?><!--product-list" class="btn btn-info pull-left">Back</a>-->
				<button type="submit" class="btn btn-success pull-left">Save</button>
			</div>
			</form>
		</div>
	</div>
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
	$(document).ready(function () {
		$("#product_title").on('input click', function () {
			var text = $("#product_title").val();
			var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
			$("#product_name").val(word);
			$.ajax({
				data: {url: word},
				type: "POST",
				url: '<?php echo base_url()?>product/ProductController/urlCheck',
				success: function (result) {
					$('#produtctError').html(result);
					var str2 = "es";
					var word = $("#product_name").val(word);
					if (result) {
						var text = $("#product_title").val();
						var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
						var word = word.concat(str2);
						$("#product_name").val(word);

					} else {
						var text = $("#product_title").val();
						var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
						$("#product_name").val(word);
					}
				}
			});
		});

		$('#sku').on('click input mouseenter', function () {

			var sku = $(this).val();
			$.ajax({
				data: {sku: sku},
				type: "POST",
				url: '<?php echo base_url()?>product/ProductController/skuCheck',
				success: function (result) {


					if (result) {

						$('#sku_error').html(result);
					} else {

						$('#sku_error').html('');
					}
				}
			});

		});
	});
</script>
