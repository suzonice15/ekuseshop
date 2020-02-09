<div id="ajaxdata" class="table-responsive">
	<table id="dat4aTable" class="table table-bordered table-striped">
		<thead>
		<tr>
			<th>Sl</th>
			<th><input type="checkbox" id="checkAll"></th>
			<th>Product Code</th>
			<th>Product</th>
			<th>Category</th>
			<th hidden>Purchase Price</th>
			<th>Sell Price</th>
			<th>Discount Price</th>
			<th>Qty.</th>
			<th>Cration date</th>
			<th class="text-right">Action</th>
		</tr>
		</thead>
		<tbody>


		<?php
		if (isset($products)) {
			$html = NULL;
			$i=0;
			foreach ($products as $prod) {
				$stock_qty = get_product_meta($prod->product_id, 'stock_qty');
				$categoryName = get_result("SELECT * FROM  category
join term_relation on term_relation.term_id=category.category_id
WHERE product_id=$prod->product_id");
				foreach ($categoryName as $category) {
					$category_title[] = $category->category_title;


				}
				$category_name = implode(',', $category_title);
				unset($category_title);

				$featured_image = get_product_meta($prod->product_id, 'featured_image');
				$featured_image = get_media_path($featured_image);

				?>
				<tr>
					<td><?php echo ++$i; ?>
					</td>
					<td>
						<input type="checkbox" id="singleId" class="checkAll"
							   value="<?php echo $prod->product_id ?>"/>
					</td>
					<td>
						<?php echo $prod->sku; ?>
					</td>

					<td>
						<img src="<?php echo $featured_image ?>" width="30"
							 height="30"/>
						&nbsp; <?php echo $prod->product_title ?>
					</td>
					<td><?php echo $category_name ?> </td>


					<td hidden><?php echo $prod->purchase_price; ?></td>

					<td><?php echo $prod->product_price; ?></td>
					<td><?php echo $prod->discount_price; ?></td>
					<td> <?php echo $prod->product_stock; ?></td>
					<td> <?php echo $prod->created_time; ?></td>


					<td class="action text-right">
						<a title="edit"
						   href="<?php echo base_url() ?>product-edit/<?php echo $prod->product_id ?>"
						<span class="glyphicon glyphicon-edit btn btn-success"></span>
						</a>


						<a title="delete"
						   id="deleteSingleAll"
						   onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
															<span
																class="glyphicon glyphicon-trash btn btn-danger"></span>
						</a>


					</td>
				</tr>
				<?php
			}


		}
		?>
		</tbody>
	</table>
</div>

</div>

<script>
	$(document).ready(function () {
		$("#pagination a").attr('onclick', 'return main_page_pagination($(this));');
	});
</script>


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
		var categoryId = new Array();

		var allId = $('.checkAll').val();
		$('.checkAll').each(function () {
			if ($(this).is(":checked")) {
				categoryId.push(this.id);
			}
		});
		if (categoryId.length > 0) {
			$.ajax({

				url: '<?php echo base_url()?>category/categoryController/multipleDelete',
				data: {category_id: categoryId},
				type: 'post',
				success: function (data) {
					alert(data)
					window.location = '<?php echo base_url()?>category-list';
				}
			});
		} else {
			alert("Select at least one product checkbox");

		}


	});

</script>

