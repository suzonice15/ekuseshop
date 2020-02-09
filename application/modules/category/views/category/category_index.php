<div class="col-md-offset-0 col-md-12">
<div class="box  box-success">
	<div class="box-header with-border">
		<h3 class="box-title pull-right">

            <a class="btn btn-info " href="<?php echo base_url();?>category-create"><i class="fa fa-plus-circle"></i>Add new</span></a>
            <a class="btn btn-danger " id="deleteAll"  onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')" >Delete</span></a>

        </h3>


	</div>
	<div class="box-body">
<div class="table-responsive">
		<table id="example1" class="table table-bordered table-striped table-responsive ">
			<thead>
			<tr>
				<th><input type="checkbox" id="checkAll"></th>
				<th>Sl</th>
				<th>Category</th>
				<th>Category Url</th>
				<th>Rank</th>
				<th>Category Id</th>


				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			<?php if (isset($categories)){
            $count = 0;
            foreach ($categories as $category) {
if($category->parent_id==0) {
    $categoryId = $category->category_id;
    ?>
    <tr>

        <td><input type="checkbox" id="<?php echo $category->category_id; ?>" class="checkAll" value="<?php echo  $category->category_id; ?>"></td>

        <td><?php echo ++$count; ?></td>
        <td><?php echo $category->category_title; ?></td>
        <td><?php echo $category->category_name; ?></td>
        <td><?php echo $category->rank_order; ?></td>
        <td><?php echo $category->category_id; ?></td>
        <td>
            <a title="edit"
               href="<?php echo base_url() ?>category-edit/<?php echo $category->category_id; ?>"
            <span class="glyphicon glyphicon-edit btn btn-success"></span>
            </a>
            <a title="delete"
               href="<?php echo base_url() ?>category-delete/<?php echo $category->category_id; ?>"
               onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
                <span class="glyphicon glyphicon-trash btn btn-danger"></span>
            </a>

        </td>
    </tr>
    <?php
    $query = "SELECT * FROM `category` where parent_id=$categoryId ORDER BY `category_id` ASC";
    $subCategory = $this->db->query($query)->result();
    if ($subCategory) {
        foreach ($subCategory as $sub) {

            $subCategoryId = $sub->category_id;
            ?>
            <tr>

                <td><input type="checkbox" class="checkAll" id="<?php echo $sub->category_id; ?>" value="<?php echo  $sub->category_id; ?>"></td>

                <td><?php echo ++$count; ?></td>
                <td><?php echo '-' . $sub->category_title; ?></td>
                <td><?php echo $sub->category_name; ?></td>
                <td><?php echo $sub->rank_order; ?></td>
                <td><?php echo $sub->category_id; ?></td>
                <td><a title="edit"
                       href="<?php echo base_url() ?>category-edit/<?php echo $sub->category_id; ?>"
                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                    </a>
                    <a title="delete"
                       href="<?php echo base_url() ?>category-delete/<?php echo $sub->category_id; ?>"
                       onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
                        <span class="glyphicon glyphicon-trash btn btn-danger"></span>
                    </a>
                </td>
            </tr>
            <?php
            $query = "SELECT * FROM `category` where parent_id=$subCategoryId ORDER BY `category_id` ASC";
            $subSubCategory = $this->db->query($query)->result();
            if ($subSubCategory) {
                foreach ($subSubCategory as $subSub) {
                    ?>
                    <tr>

                        <td><input type="checkbox" class="checkAll" id="<?php echo $subSub->category_id; ?>" value="<?php echo $subSub->category_id; ?>"></td>

                        <td><?php echo ++$count; ?></td>
                        <td><?php echo '--' . $subSub->category_title; ?></td>
                        <td><?php echo $subSub->category_name; ?></td>
                        <td><?php echo $subSub->rank_order; ?></td>
                        <td><?php echo $subSub->category_id; ?></td>
                        <td><a title="edit"
                               href="<?php echo base_url() ?>category-edit/<?php echo $subSub->category_id; ?>"
                            <span class="glyphicon glyphicon-edit btn btn-success"></span>
                            </a>
                            <a title="delete"
                               href="<?php echo base_url() ?>category-delete/<?php echo $subSub->category_id; ?>"
                               onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
                                <span class="glyphicon glyphicon-trash btn btn-danger"></span>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            }
        }
    }
}

               
            }
            }

			?>

			</tbody>

		</table>
</div>


	</div>

</div>
</div>

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
