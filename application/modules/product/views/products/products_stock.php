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
										<div class="col-md-12 col-sm-6 col-xs-12">
											<?php echo get_req_message(); ?>
										</div>
										<div class="col-md-12 col-sm-6 col-xs-12" style="text-align:right;">
											<a href="<?php echo base_url()?>product-create" class="btn btn-success ">Add New</a>
											&nbsp;&nbsp;
											<?php
//											if($user_type=='admin' || $user_type=='super-admin')
//											{
												?><input type="submit" name="delete" value="Delete" id="deleteAll"  onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')" class="btn btn-danger pull-right " id="del_all" data-table="product"/><?php
										//	}
											?>
										</div>
									</div>
								</div>
								<br/>
								<br/>


								<?php
								$prod_stock_summary = get_result("SELECT SUM(sp.stock_qty * pm1.meta_value) as stock_value, 
							SUM(sp.stock_qty * pm3.meta_value) as purchase_value, 
							SUM(sp.stock_qty) as stock_items 
							FROM stock_product as sp 
							JOIN productmeta as pm1 ON sp.product_id = pm1.product_id 
							JOIN productmeta as pm3 ON sp.product_id = pm3.product_id 
							WHERE pm1.meta_key = 'sell_price' 
							AND pm3.meta_key = 'purchase_price' 
							AND sp.stock_status = '$status'");
								foreach($prod_stock_summary as $prod_stock_info);
								?>

								<div class="result">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
										<tr>
											<th><input type="checkbox" id="checkAll"></th>
											<th>SKU</th>
											<th>Product</th>

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
											//}
											?>

											<th>Total<br>Sell Price</th>
											<th class="text-right">&nbsp;</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>

<!--											--><?php
//											if($user_type=='admin' || $user_type=='super-admin')
//											{
												?><td>&nbsp;</td><?php
//											}
//											?>

											<td>&nbsp;</td>
											<td><b>Total<br>Product<br>Qty.</b><br><?=$prod_stock_info->stock_items?></td>

											<?php
//											if($user_type=='admin' || $user_type=='super-admin')
//											{
												?><td><b>Grand<br>Purchase<br>Price:</b><br><?=$prod_stock_info->purchase_value?></td><?php
										//	}

											?>
											<td><b>Grand<br>Sell<br>Price:</b><br><?=$prod_stock_info->stock_value?></td>
											<td>&nbsp;</td>
										</tr>

										<?php
										if(isset($products))
										{
											$html=NULL;

											foreach($products as $prod)
											{
												$product_title = get_product_title($prod->product_id);

												$stock_qty = $prod->stock_qty;
												if(empty($stock_qty)){
													$stock_qty=0;
												}

												$purchase_price = get_product_meta($prod->product_id, 'purchase_price');
												if(empty($purchase_price)){
													$purchase_price=0;
												}
												$sell_price = get_product_meta($prod->product_id, 'sell_price');
												if(empty($sell_price)){
													$sell_price=0;
												}
												$featured_image = get_product_meta($prod->product_id, 'featured_image');
												$featured_image = get_media_path($featured_image);

												$html.='<tr>
												<td>
													<input type="checkbox" name="checkbox[]" id="checkbox[]" class="checkAll" value="'.$prod->stock_id.'" />
												</td>
												<td>'.get_product_meta($prod->product_id, 'sku').'</td>
												<td>
													<img src="'.$featured_image.'" width="30" height="30"> &nbsp; '.$product_title.'
												</td>';

//												if($user_type=='admin' || $user_type=='super-admin')
//												{
													$html.='<td>'.$purchase_price.'</td>';
												//}

												$html.='<td>'.$sell_price.'</td>
												<td>'.$stock_qty.'</td>';

//												if($user_type=='admin' || $user_type=='super-admin')
//												{
													$html.='<td>'.$stock_qty * $purchase_price.'</td>';
											//	}

												$html.='<td>'.$stock_qty * $sell_price.'</td>
												<td class="action text-right">
													<a class="glyphicon glyphicon-edit btn btn-success" href="'.base_url().'product-edit/'.$prod->product_id.'">&nbsp;</a>';

//												if($user_type=='admin' || $user_type=='super-admin')
//												{

											//	}

												$html.='</td>
											</tr>';
											}

											echo $html;
										}
										?>
										</tbody>
									</table>
								</div>
							</form>
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
		var url      = window.location.href;     // Returns full URL (https://example.com/path/example.html)
		var  productId = new Array();

		//var allId=$('.checkAll').val();
		$('.checkAll').each(function(){
			if($(this).is(":checked")) {
				productId.push(this.value);
			}
		} );
if(productId.length >0) {
	$.ajax({

		url: '<?php echo base_url()?>product/ProductController/deleteBadProduct',
		data: {stock_id: productId},
		type: 'post',
		success: function (data) {
			alert(data)
			window.location = url;
		}
	});
} else {
	alert("select the product list");
}


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
				window.location = url;
			}
		});


	});

</script>
