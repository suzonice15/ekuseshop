<div class="col-md-offset-0 col-md-12">
	<div class="box  box-success">
		<div class="box-header with-border">
			<!--		<h3 class="box-title pull-right">-->
			<!---->
			<!--            <a class="btn btn-info " href="--><?php //echo base_url();?><!--med-create"><i class="fa fa-plus-circle"></i>Add new</span></a>-->
			<!--            <a class="btn btn-danger " id="deleteAll"  onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')" >Delete</span></a>-->
			<!---->
			<!--        </h3>-->
			<!---->


		</div>
		<div class="box-body">
			<div class="table-responsive" id="ajaxdata">
				<table id="examplje1" class="table table-bordered table-striped table-responsive ">
					<thead>
					<tr>
						<th><input type="checkbox" id="checkAll"></th>
						<th>Sl</th>
						<th width="10%">Picture</th>
						<th width="30%">Media </th>
						<th width="30%">Url </th>
					</tr>
					</thead>
					<tbody>
					<?php if (isset($media)){
						$count = 0;
						foreach ($media as $med) {

							?>
							<tr>

								<td><input type="checkbox" id="<?php echo $med->media_id; ?>" class="checkAll" value="<?php echo  $med->media_id; ?>"></td>

								<td><?php echo ++$count; ?></td>
								<td>

									<img src="<?php echo base_url();echo $med->media_path; ?>" width="50" height="50"/>
								</td>
								<td><?php echo $med->media_title; ?></td>
								<td> <input id="url_<?php echo $med->media_id ?>"  class="form-control lg " value="<?php echo base_url();echo $med->media_path;?>"/>
									<button  id="<?php echo $med->media_id ?>" class="btn btn-success selectAllUrl">Copy text</button>

								</td>

							</tr>

						<?php }} ?>
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
		var medId = new Array();

		var allId = $('.checkAll').val();
		$('.checkAll').each(function () {
			if ($(this).is(":checked")) {
				medId.push(this.id);
			}
		});
		if (medId.length > 0) {
			$.ajax({

				url: '<?php echo base_url()?>media/MediaController/multipleDelete',
				data: {med_id: medId},
				type: 'post',
				success: function (data) {
					alert(data)
					window.location = '<?php echo base_url()?>med-list';
				}
			});
		} else {
			alert("Select at least one product checkbox");

		}


	});

</script>
<script>
	$(document).ready(function () {
		$("#ajax_pagingsearc a").attr('onclick', 'return main_page_pagination($(this));');
	});
</script>


<script>
	$('.selectAllUrl').on('click',function () {
		url_id=this.id;
		var urlLink=$('#url_'+url_id);
		urlLink.select();
		document.execCommand("copy");
	})



</script>
