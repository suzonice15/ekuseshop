<div class="col-md-offset-0 col-md-12">
<div class="box  box-success">
	<div class="box-header with-border">
		<h3 class="box-title pull-right">

            <a class="btn btn-success " href="<?php echo base_url();?>slider-create"><i class="fa fa-plus-circle"></i>Add new</span></a>
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
				<th>slider</th>
				<th>slider Url</th>
				
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			<?php if (isset($sliders)){
            $count = 0;
            foreach ($sliders as $slider) {

    ?>
    <tr>

        <td><input type="checkbox" id="<?php echo $slider->homeslider_id; ?>" class="checkAll" value="<?php echo  $slider->homeslider_id; ?>"></td>

        <td><?php echo ++$count; ?></td>
        <?php

			if($slider->homeslider_banner):

			?>
				<td><img width="80" height="50" src="<?php echo base_url(); echo $slider->homeslider_banner;?>"/></td>

			<?php else : ?>
				<td><img width="80" height="50" src="<?php echo base_url(); ?>uploads/no.jpg"/></td>
<?php endif;?>
				<td><?php echo $slider->homeslider_title; ?></td>
        <td><a title="edit"
               href="<?php echo base_url() ?>slider-edit/<?php echo $slider->homeslider_id; ?>"
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
		var sliderId = new Array();
		var allId = $('.checkAll').val();
		$('.checkAll').each(function () {
			if ($(this).is(":checked")) {
				sliderId.push(this.value);
			}
		});
		if (sliderId.length > 0) {
			$.ajax({

				url: '<?php echo base_url()?>slider/sliderController/multipleDelete',
				data: {homeslider_id: sliderId},
				type: 'post',
				success: function (data) {
					alert(data)
					window.location = '<?php echo base_url()?>slider-list';
				}

			});
		} else {
		 alert("Select at least one product checkbox");

	}


	});

</script>
