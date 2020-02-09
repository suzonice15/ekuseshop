<div class="col-md-offset-0 col-md-12">
<div class="box  box-success">
	<div class="box-header with-border">
		<h3 class="box-title pull-right">

            <a class="btn btn-success " href="<?php echo base_url();?>add-create"><i class="fa fa-plus-circle"></i>Add new</span></a>
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
				<th>Image</th>
				<th>Title</th>
				<th>Position</th>

				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			<?php if (isset($adds)){
            $count = 0;
            foreach ($adds as $add) {
			//	$media_path = get_media_path($add->media_id);

				$media_path=base_url().$add->media_path;
				?>
    <tr>

        <td><input type="checkbox" id="<?php echo $add->adds_id; ?>" class="checkAll" value="<?php echo  $add->adds_id; ?>"></td>

        <td><?php echo ++$count; ?></td>
        <?php

			if($media_path):

			?>
				<td><img width="80" height="50" src="<?php echo $media_path;?>"/></td>

			<?php else : ?>
				<td><img width="80" height="50" src="<?php echo base_url(); ?>uploads/no.jpg"/></td>
<?php endif;?>
				<td><?php echo $add->adds_title; ?></td>
		<td><?php echo $add->adds_type; ?></td>
        <td><a title="edit"
               href="<?php echo base_url() ?>add-edit/<?php echo $add->adds_id; ?>"
            <span class="glyphicon glyphicon-edit btn btn-success"></span>
            </a>
<!--            <a title="delete" id="deleteAll"-->
<!---->
<!--               onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">-->
<!--                <span class="glyphicon glyphicon-trash btn btn-danger"></span>-->
<!--            </a>-->
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
		var addId = new Array();
		var allId = $('.checkAll').val();
		$('.checkAll').each(function () {
			if ($(this).is(":checked")) {
				addId.push(this.value);
			}
		});

		if (addId.length > 0) {
			$.ajax({

				url: '<?php echo base_url()?>add/addController/multipleDelete',
				data: {adds_id: addId},
				type: 'post',
				success: function (data) {
					alert(data)
					window.location = '<?php echo base_url()?>add-list';
				}

			});
		} else {
		 alert("Select at least one product checkbox");

	}


	});

</script>
