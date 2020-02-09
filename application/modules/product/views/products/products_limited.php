<div class="col-md-offset-0 col-md-12">
	<!--<div class="box  box-success">-->
	<!--	<div class="box-header with-border">-->
	<!--		<h3 class="box-title pull-right">-->
	<!---->
	<!--            <a class="btn btn-info " href="--><?php //echo base_url();?><!--category-create"><i class="fa fa-plus-circle"></i>Add new</span></a>-->
	<!--            <a class="btn btn-danger " id="deleteAll" href="" ><i class="fa fa-plus-circle"></i>Delete</span></a>-->
	<!---->
	<!--        </h3>-->
	<!---->
	<!---->
	<!--	</div>-->
	<div class="box-body">
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-success">
						<div class="box-body">
							<form method="POST">
								<div class="btnarea">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">

											<input type="submit" name="delete" value="Delete" id="deleteAll"  onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')" class="btn btn-danger pull-right" id="del_all" data-table="product"/>

										</div>
										<div class="col-md-2 col-sm-6 col-xs-12" style="text-align:left;">

										</div>

									</div>
								</div>
								<?php

								$prod_stock_summary = get_result("SELECT SUM(pm1.meta_value * pm2.meta_value) as stock_value, 
								SUM(pm3.meta_value * pm2.meta_value) as purchase_value, 
								SUM(pm2.meta_value) as stock_items 
								FROM product as p 
								JOIN productmeta as pm1 ON p.product_id = pm1.product_id 
								JOIN productmeta as pm2 ON p.product_id = pm2.product_id 
								JOIN productmeta as pm3 ON p.product_id = pm3.product_id 
								WHERE pm1.meta_key = 'sell_price' 
								AND pm2.meta_key = 'stock_qty' 
								AND pm3.meta_key = 'purchase_price'");

								//echo "<pre>"; print_r($prod_stock_summary);  echo "</pre>"; die();

								foreach($prod_stock_summary as $prod_stock_info);

								?>

								<div id="ajaxdata" class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
										<tr>
											<th><input type="checkbox" id="checkAll"></th>
											<th>SKU</th>
											<th>Product</th>
											<th hidden>Product Name</th>

											<?php
											//											if($user_type=='admin' || $user_type=='super-admin')
											//											{
											?><th>Purchase Price</th><?php
											//}
											?>

											<th>Sell Price</th>
											<th>Qty.</th>

											<?php
											//											if($user_type=='admin' || $user_type=='super-admin')
											//											{
											?><th>Total<br>Purchase Price</th><?php
											//	}
											?>

											<th>Total<br>Sell Price</th>
											<th class="text-right">Action</th>
										</tr>
										</thead>
										<tbody>
										<?php
										//										if(isset($page_type) && $page_type=='general')
										//										{

										?>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td hidden>&nbsp;</td>

											<?php
											//											if($user_type=='admin' || $user_type=='super-admin')
											//											{
											?><td>&nbsp;</td><?php
											//}
											?>

											<td>&nbsp;</td>
											<td><b>Total<br>Product<br>Qty.</b><br><?=$prod_stock_info->stock_items?></td>

											<?php
											//											if($user_type=='admin' || $user_type=='super-admin')
											//											{
											?><td><b>Grand<br>Purchase<br>Price:</b><br><?=$prod_stock_info->purchase_value?></td><?php
											//			}
											?>

											<td><b>Grand<br>Sell<br>Price:</b><br><?=$prod_stock_info->stock_value?></td>
											<td>&nbsp;</td>
										</tr>
										<?php
										//}
										?>

										<?php
										if(isset($products))
										{
											$html=NULL;

											foreach($products as $prod)
											{
												$stock_qty = get_product_meta($prod->product_id, 'stock_qty');

												//var_dump($stock_qty);exit();
												$purchase_price = get_product_meta($prod->product_id, 'purchase_price');
												$sell_price = get_product_meta($prod->product_id, 'sell_price');

												$featured_image = get_product_meta($prod->product_id, 'featured_image');
												$featured_image = get_media_path($featured_image);
												if(empty($stock_qty)){
													$stock_qty=0;

												}
												if( empty($purchase_price) ){

													$purchase_price=0;

												}
												if( empty($sell_price)){

													$sell_price=0;
												}

												?>
												<tr>
													<td>
														<input type="checkbox"  id="singleId"    class="checkAll"    value="<?php echo $prod->product_id ?>" />
													</td>
													<td><?php echo get_product_meta($prod->product_id, 'sku') ?> </td>
													<td>
														<img src="<?php echo $featured_image ?>" width="30" height="30"> &nbsp; <?php echo $prod->product_title ?>
													</td>
													<td hidden><?php echo $prod->product_name ?> </td>

													<!--//												if($user_type=='admin' || $user_type=='super-admin')-->
													<!--//												{-->
													<td><?php echo $purchase_price ?></td>
													<!--											//	}-->

													<td><?php echo $sell_price ?></td>
													<td> <?php echo $stock_qty  ?></td>

													<!--//												if($user_type=='admin' || $user_type=='super-admin')-->
													<!--//												{-->
													<td><?php echo $stock_qty * $purchase_price  ?></td>
													<!--											//	}-->

													<td> <?php echo $stock_qty * $sell_price  ?> </td>
													<td class="action text-right">
														<a title="edit"
														   href="<?php echo base_url() ?>product-edit/<?php echo $prod->product_id ?>"
														<span class="glyphicon glyphicon-edit btn btn-success"></span>
														</a>

														<!---->
														<!--//												if($user_type=='admin' || $user_type=='super-admin')-->
														<!--//												{-->
														<a title="delete"
														   id="deleteSingleAll"  onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')"  >
															<span class="glyphicon glyphicon-trash btn btn-danger"></span>
														</a>
														<!--											//	}-->

													</td>
												</tr>
												<?php
											}


										}
										?>
										</tbody>
									</table>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

</div>

</div>
</div>
<!---->
<!--<script>-->
<!--	$(document).ready(function () {-->
<!--		$("#ajax_pagingsearc a").attr('onclick', 'return main_page_pagination($(this));');-->
<!--	});-->
<!--</script>-->
<!---->
<!--<script>-->
<!--	function main_page_pagination($this) {-->
<!--		var url = $this.attr("href");-->
<!--		if (url != '') {-->
<!--			$.ajax({-->
<!--				type: "POST",-->
<!--				url: url,-->
<!--				success: function (msg) {-->
<!--					$("#ajaxdata").html(msg);-->
<!--				}-->
<!--			});-->
<!--		}-->
<!--		return false;-->
<!--	}-->
<!--</script>-->
<!---->
<!--<script>-->
<!--	function search_content() {-->
<!--		var base_url = "--><?php //echo base_url()?>//";
//
//		var product_title = $('#product_title').val();
//		var counter = $('#counter').val();
//
//
//		if ($.trim(product_title) != ""  ) {
//			$.ajax({
//				type: 'post',
//				url: '<?php //echo base_url()?>//product/ProductController/index',
//				data: {product_title: product_title,counter:counter },
//				success: function (data) {
//					$("#ajaxdata").html(data);
//				}
//			});
//		} else {
//			$.post(base_url + "product/ProductController/index", function (data) {
//				$("#ajaxdata").html(data);
//			});
//		}
//	}
//</script>
//<script>
//	function totalProductCount() {
//		var base_url = "<?php //echo base_url()?>//";
//		var counter = $('#counter').val();
//		if ($.trim(counter) != ""  ) {
//			$.ajax({
//				type: 'post',
//				url: '<?php //echo base_url()?>//product/ProductController/index',
//				data: { counter:counter },
//				success: function (data) {
//					$("#ajaxdata").html(data);
//				}
//			});
//		} else {
//			$.post(base_url + "product-list", function (data) {
//				$("#ajaxdata").html(data);
//			});
//		}
//	}
//</script>
//



<script>

	$('#checkAll').change(function(){

		if($(this).is(":checked")){

			$('.checkAll').prop('checked',true);

		}

		else if($(this).is(":not(:checked)")){

			$('.checkAll').prop('checked',false);

		}

	});
	$('#deleteAll').click(function (e) {
		e.preventDefault();
		var  productId = new Array();

		//var allId=$('.checkAll').val();
		$('.checkAll').each(function(){
			if($(this).is(":checked")) {
				productId.push(this.value);
			}
		} );

		$.ajax({

			url:'<?php echo base_url()?>product/ProductController/multipleDelete',
			data:{product_id:productId},
			type:'post',
			success:function (data) {
				alert(data)
				window.location='<?php echo base_url()?>product-limited';
			}
		});


	});
	$(document).on( 'click','#deleteSingleAll',function (e) {
		e.preventDefault();
		var productId =$('#singleId').val();

		$.ajax({

			url:'<?php echo base_url()?>product/ProductController/destroy',
			data:{product_id:productId},
			type:'post',
			success:function (data) {
				alert(data)
				window.location='<?php echo base_url()?>product-limited';
			}
		});


	});

</script>
